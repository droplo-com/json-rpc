<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Test;

use PHPUnit\Framework\TestCase;
use JsonRpc\Traits\{
	Id, Resource, Method, Params, Result, ResultError
};

class TraitsTest extends TestCase {
	public function testSetIdValid() {
		$mock = $this->getMockForTrait(Id::class);
		$mock->setId(10);
		$this->assertEquals(10, $mock->getId());
		$mock->setId();
		$this->assertEquals(1, $mock->getId());
	}

	public function testSetIdEmptyString() {
		$this->expectException('Error');
		$mock = $this->getMockForTrait(Id::class);
		$mock->setId(12.2);
	}

	public function testSetResourceValid() {
		$mock = $this->getMockForTrait(Resource::class);
		$mock->setResource('SomeResource');
		$this->assertEquals('SomeResource', $mock->getResource());
	}

	public function testSetResourceEmptyString() {
		$this->expectException('Error');
		$mock = $this->getMockForTrait(Resource::class);
		$mock->setResource('');
	}

	public function testSetMethodValid() {
		$mock = $this->getMockForTrait(Method::class);
		$mock->setMethod('SomeMethod');
		$this->assertEquals('SomeMethod', $mock->getMethod());
	}

	public function testSetMethodEmptyString() {
		$this->expectException('Error');
		$mock = $this->getMockForTrait(Method::class);
		$mock->setMethod('');
	}

	public function testSetParamsValid() {
		$mock = $this->getMockForTrait(Params::class);
		$mock->setParams([]);
		$this->assertEquals([], $mock->getParams());
	}

	public function testSetParamsEmptyString() {
		$this->expectException('Error');
		$mock = $this->getMockForTrait(Params::class);
		$mock->setParams('someParam');
	}

	public function testSetResultValid() {
		$mock = $this->getMockForTrait(Result::class);
		$mock->setResult('SomeResult');
		$this->assertEquals('SomeResult', $mock->getResult());
	}

	public function testSetResultErrorValid() {
		$mock = $this->getMockForTrait(ResultError::class);
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
		$this->expectException('Error');
		$mock = $this->getMockForTrait(ResultError::class);
		$mock->setError('');
	}
}
