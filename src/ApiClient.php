<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
class ApiClient {
	/**
	 * @var Client
	 */
	public $client;

	public function __construct($endpoint) {
		$this->client = new Client($endpoint);
	}

	/**
	 * @param $name
	 *
	 * @return Resource
	 */
	public function __get($name) {
		$resource = new Resource($this, $name);

		return $resource;
	}
}

class Resource {
	public $apiClient;
	public $name;

	/**
	 * Resource constructor.
	 *
	 * @param ApiClient $apiClient
	 * @param string $name
	 */
	public function __construct($apiClient, $name) {
		$this->apiClient = $apiClient;
		$this->name = $name;
	}

	/**
	 * @param string $name
	 * @param $params
	 *
	 * @return mixed
	 */
	public function __call($name, $params) {
		$params = isset($params[0]) ? $params[0] : [];
		$request = new Request([
			'resource' => $this->name,
			'method' => $name,
			'params' => $params
		]);
		$response = $this->apiClient->client->send($request);
		if ($error = $response->getError()) {
			throw new \Error($error['message'], (int)$error['code']);
		}

		return $response->getResult();
	}
}
