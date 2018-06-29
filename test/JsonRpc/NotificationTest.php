<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use PHPUnit\Framework\TestCase;
use JsonRpc\Notification;

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
