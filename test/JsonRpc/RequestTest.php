<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use PHPUnit\Framework\TestCase;
use JsonRpc\Request;

class RequestTest extends TestCase {
	public function testConstructor() {
		$this->assertInstanceOf(Request::class, new Request());
		$this->assertInstanceOf(Request::class, new Request([
			'resource' => 'Test',
			'method' => 'test',
			'params' => []
		]));
	}
	public function testToStringThrowOnMissingProps() {
		$this->expectException(\Error::class);
		(new Request())->toString();
	}
}
