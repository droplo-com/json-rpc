<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\ApiClient;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase {
	public function testCall() {
		$client = new ApiClient('http://localhost:8080/');
		$response = $client->Test->echo(['param' => 'value']);
		$this->assertEquals(['param' => 'value'], $response);
	}
}
