<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use PHPUnit\Framework\TestCase;
use JsonRpc\Response;

class ResponseTest extends TestCase {
	public function testConstructor() {
		$this->assertInstanceOf(Response::class, new Response());
		$response = new Response([
			'id' => 1,
			'result' => 'ok'
		]);
		$this->assertInstanceOf(Response::class, $response);
		$this->assertEquals('{"version":"1.2.0","id":1,"result":"ok"}', $response->toString());
		$response = new Response([
			'id' => 1,
			'error' => ['code' => 'error_code', 'message' => 'error_message']
		]);
		$this->assertInstanceOf(Response::class, $response);
		$this->assertEquals('{"version":"1.2.0","id":1,"error":{"code":"error_code","message":"error_message"}}', $response->toString());
	}

	public function testToStringThrowOnMissingProps() {
		$this->expectException(\Error::class);
		(new Response())->toString();
	}
}
