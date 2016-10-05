<?php
namespace Courier;

/**
 * Courier
 *
 * @author <me@dylanjpierce.com>
 */

class Courier
{
	/**
	 * @var string
	 */
	const TEXTBELT_URL = 'http://textbelt.com/';

	/**
	 * @var array
	 */
	protected $message;

	/**
	 * @var array 
	 */
	protected $regions = [
		'us' => 'text',
		'ca' => 'canada',
		'intl' => 'intl',
	];

	/**
	 * Constructor
	 *
	 * @param array
	 * @param array
	 * @return void
	 */
	public function __construct($message = [], $options = [])
	{
		$this->message = $message;
		$this->options = $options;

		if(!isset($options['region'])) {
			$this->options['region'] = 'us';
		}
	}


	/**
	 * Make a new message
	 * 
	 * @return Courier
	 */
	public function make()
	{
		$this->message = [];

		return $this;
	}
	
	/**
	 * Set sender
	 * 
	 * @param string
	 * @return Courier
	 */
	public function setSender($sender)
	{
		$this->message['sender'] = $sender;

		return $this;
	}

	/**
	 * Set Recipient
	 *
	 * @param string
	 * @return Courier
	 */
	public function setRecipient($recipient)
	{
		$this->message['recipient'] = $recipient;

		return $this;
	}

	/**
	 * Set Body
	 * 
	 * @param string
	 * @return Courier
	 */
	public function setBody($body)
	{
		$this->message['body'] = $body;

		return $this;
	}

	/**
	 * Set Region
	 *
	 * @param string
	 * @return Courier
	 */
	public function setRegion($region)
	{
		$this->options['region'] = $region;

		return $this;
	}

	/**
	 * Send message
	 * 
	 * @return Courier
	 */
	public function send()
	{
		$message = http_build_query([
			'number' => $this->message['recipient'],
		    'message' => $this->message['body']
		]);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, self::TEXTBELT_URL . $this->region[$this->options['region']]);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		$this->make();

		return $this;
	}
}