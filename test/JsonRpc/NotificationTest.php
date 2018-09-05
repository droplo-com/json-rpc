<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase {
	public function testConstructor() {
		$this->assertInstanceOf('JsonRpc\Notification', new Notification());
		$this->assertInstanceOf('JsonRpc\Notification', new Notification([
			'resource' => 'Test',
			'method' => 'test',
			'params' => []
		]));
	}

	public function testToStringThrowOnMissingProps() {
		$this->setExpectedException('Error');
		(new Notification())->toString();
	}
}
