<?php
namespace Courier;

/**
 * Courier
 *
 * @author <me@dylanjpierce.com>
 */
use GuzzleHttp\Client as Guzzle;

class Courier
{
	/**
	 * @var string
	 */
	const TEXTBELT_URL = 'http://textbelt.com/';

	/**
	 * @var Guzzle
	 */
	private $guzzle;

	/**
	 * @var array
	 */
	private $message;

	/**
	 * @var array 
	 */
	private $regions = [
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

		$this->guzzle = new Guzzle([
			'base_uri' => self::TEXTBELT_URL,
		]);
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
		$response = $this->guzzle->request('POST', $this->regions[$this->options['region']],  [
			'form_params' => [
				'number' => $this->message['recipient'],
			    'message' => $this->message['body']
			],
		]);

		$this->make();

		return $response;
	}
}