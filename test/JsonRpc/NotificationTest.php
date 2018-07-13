<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase {
	public function testConstructor() {
		$this->assertInstanceOf(Notification::class, new Notification());
		$this->assertInstanceOf(Notification::class, new Notification([
			'resource' => 'Test',
			'method' => 'test',
			'params' => []
		]));
	}

	public function testToStringThrowOnMissingProps() {
		$this->expectException(\Error::class);
		(new Notification())->toString();
	}
}
