<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
class Client {
	private $endpoint = '';

	/**
	 * Client constructor.
	 *
	 * @param $endpoint
	 */
	public function __construct($endpoint) {
		if (!is_string($endpoint) || !strlen($endpoint)) {
			throw new \Error('$endpoint must be not empty string');
		}
		$this->endpoint = $endpoint;
	}

	/**
	 * @param Notification|Request|array $message
	 *
	 * @throws \Error
	 * @return Response
	 */
	public function send($message) {
		if (is_array($message)) {
			$message = JsonRpc::parse($message);
		}
		if (!($message instanceof Request || $message instanceof Notification)) {
			throw new \Error('Only Request or Notification messages are allowed');
		}

		return JsonRpc::parse($this->request($message->toString()));
	}

	/**
	 * @param $string
	 *
	 * @return mixed
	 */
	private function request($string) {
		$curl = \curl_init($this->endpoint);
		\curl_setopt($curl, CURLOPT_HEADER, false);
		\curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		\curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-type: application/json"]);
		\curl_setopt($curl, CURLOPT_POST, true);
		\curl_setopt($curl, CURLOPT_POSTFIELDS, $string);
		$response = \curl_exec($curl);
		$status = \curl_getinfo($curl, CURLINFO_HTTP_CODE);
		if ($status != 200) {
			throw new \Error("Status: " . $status);
		}
		\curl_close($curl);

		return $response;
	}
}
