<?php
namespace Courier;

/**
 * Service \ SMS \ TextBelt
 *
 * @author <me@dylanjpierce.com>
 */

class Courier
{
	const TEXTBELT_URL = 'http://textbelt.com/text';

	/**
	 * @var array()
	 */
	protected $message;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->message = array();
	}


	/**
	 * @return Courier
	 */
	public function make()
	{
		$this->message = array();

		return $this;
	}
	
	/**
	 * @param $sender
	 * @return Courier
	 */
	public function setSender($sender)
	{
		$this->message['sender'] = $sender;

		return $this;
	}

	/**
	 * @param $recipent
	 * @return Courier
	 */
	public function setRecipent($recipent)
	{
		$this->message['recipent'] = $recipent;

		return $this;
	}

	/**
	 * @param $body
	 * @return Courier
	 */
	public function setBody($body)
	{
		$this->message['body'] = $body;

		return $this;
	}

	/**
	 * @return Courier
	 */
	public function send()
	{
		$message = http_build_query([
			'number' => $this->message['recipent'],
		    'message' => $this->message['body']
		]);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, self::TEXTBELT_URL );
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec ($ch);

		curl_close ($ch);

		$this->message = array();

		return $this;
	}
}