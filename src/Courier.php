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
	const TEXTBELT_URL = 'http://textbelt.com/text';

	/**
	 * @var array()
	 */
	protected $message;

	/**
	 * Constructor
	 *
	 * @param void
	 * @return void
	 */
	public function __construct($message = [])
	{
		$this->message = array();
	}


	/**
	 * Make a new message
	 * 
	 * @return Courier
	 */
	public function make()
	{
		$this->message = array();

		return $this;
	}
	
	/**
	 * Set sender
	 * 
	 * @param $sender
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
	 * @param $recipient
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
	 * @param $body
	 * @return Courier
	 */
	public function setBody($body)
	{
		$this->message['body'] = $body;

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

		curl_setopt($ch, CURLOPT_URL, self::TEXTBELT_URL );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		$this->make();

		return $this;
	}
}