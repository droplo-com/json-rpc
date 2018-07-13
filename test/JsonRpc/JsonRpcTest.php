<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\JsonRpc;
use JsonRpc\Request;
use PHPUnit\Framework\TestCase;

class JsonRpcTest extends TestCase {
	public function testVersion() {
		$this->assertEquals(JsonRpc::$version, "1.2.0");
	}

	public function testParse() {
		$request = JsonRpc::parse('{"version":"1.2.0","id":2,"resource":"Test","method":"test","params":[]}');
		$this->assertInstanceOf(Request::class, $request);
	}
}

