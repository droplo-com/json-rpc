<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use JsonRpc\Traits\Id;
use JsonRpc\Traits\Method;
use JsonRpc\Traits\Params;
use JsonRpc\Traits\Resource;
use JsonRpc\Traits\Result;
use JsonRpc\Traits\ResultError;
use PHPUnit\Framework\TestCase;

class TraitsTest extends TestCase {
	public function testSetIdValid() {
		$mock = $this->getMockForTrait('JsonRpc\Traits\Id');
		$mock->setId(10);
		$this->assertEquals(10, $mock->getId());
		$mock->setId();
		$this->assertEquals(1, $mock->getId());
	}

	public function testSetIdEmptyString() {
		$this->setExpectedException('Error');
		$mock = $this->getMockForTrait('JsonRpc\Traits\Id');
		$mock->setId(12.2);
	}

	public function testSetResourceValid() {
		$mock = $this->getMockForTrait('JsonRpc\Traits\Resource');
		$mock->setResource('SomeResource');
		$this->assertEquals('SomeResource', $mock->getResource());
	}

	public function testSetResourceEmptyString() {
		$this->setExpectedException('Error');
		$mock = $this->getMockForTrait('JsonRpc\Traits\Resource');
		$mock->setResource('');
	}

	public function testSetMethodValid() {
		$mock = $this->getMockForTrait('JsonRpc\Traits\Method');
		$mock->setMethod('SomeMethod');
		$this->assertEquals('SomeMethod', $mock->getMethod());
	}

	public function testSetMethodEmptyString() {
		$this->setExpectedException('Error');
		$mock = $this->getMockForTrait('JsonRpc\Traits\Method');
		$mock->setMethod('');
	}

	public function testSetParamsValid() {
		$mock = $this->getMockForTrait('JsonRpc\Traits\Params');
		$mock->setParams([]);
		$this->assertEquals([], $mock->getParams());
	}

	public function testSetParamsEmptyString() {
		$this->setExpectedException('Error');
		$mock = $this->getMockForTrait('JsonRpc\Traits\Params');
		$mock->setParams('someParam');
	}

	public function testSetResultValid() {
		$mock = $this->getMockForTrait('JsonRpc\Traits\Result');
		$mock->setResult('SomeResult');
		$this->assertEquals('SomeResult', $mock->getResult());
	}

	public function testSetResultErrorValid() {
		$mock = $this->getMockForTrait('JsonRpc\Traits\ResultError');
		$mock->setError([
			'message' => 'some message',
			'code' => 'SOME_CODE'
		]);
		$this->assertEquals([
			'message' => 'some message',
			'code' => 'SOME_CODE'
		], $mock->getError());
	}

	public function testSetResultError() {
		$this->setExpectedException('Error');
		$mock = $this->getMockForTrait('JsonRpc\Traits\ResultError');
		$mock->setError('');
	}
}
