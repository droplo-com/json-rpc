<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\Client;
use JsonRpc\Request;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase {
	public function testSend() {
		$client = new Client('http://localhost:8080/');
		$response = $client->send(new Request([
			'resource' => 'Test',
			'method' => 'echo',
			'params' => ['param' => 'value']
		]));
		$this->assertEquals('{"version":"1.2.0","id":1,"result":{"param":"value"}}', $response->toString());
	}
}
