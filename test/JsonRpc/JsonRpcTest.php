<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use PHPUnit\Framework\TestCase;
use JsonRpc\JsonRpc;

class JsonRpcTest extends TestCase {
	public function testVersion() {
		$this->assertEquals(JsonRpc::$version, "1.2.0");
	}
}

