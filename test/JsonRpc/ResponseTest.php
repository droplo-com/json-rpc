<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase {
	public function testConstructor() {
		$this->assertInstanceOf('JsonRpc\Response', new Response());
		$response = new Response([
			'id' => 1,
			'result' => 'ok'
		]);
		$this->assertInstanceOf('JsonRpc\Response', $response);
		$this->assertEquals('{"version":"1.2.0","id":1,"result":"ok"}', $response->toString());
		$response = new Response([
			'id' => 1,
			'error' => [
				'code' => 'error_code',
				'message' => 'error_message'
			]
		]);
		$this->assertInstanceOf('JsonRpc\Response', $response);
		$this->assertEquals('{"version":"1.2.0","id":1,"error":{"code":"error_code","message":"error_message"}}', $response->toString());
	}

	public function testToStringThrowOnMissingProps() {
		$this->setExpectedException('Exception');
		(new Response())->toString();
	}
}
