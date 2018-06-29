<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
/**
 * Trait Method
 * @package JsonRpc\Traits
 */
trait Method {
	/**
	 * @var string
	 */
	protected $method;

	/**
	 * @return string
	 */
	public function getMethod() {
		return $this->method;
	}

	/**
	 * @param string $method
	 *
	 * @return $this
	 */
	public function setMethod($method) {
		if (!is_string($method) || !strlen($method)) {
			throw new \Error('', 0);
		}
		$this->method = $method;

		return $this;
	}
}
