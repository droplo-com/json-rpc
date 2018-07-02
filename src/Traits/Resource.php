<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
/**
 * Trait Resource
 * @package JsonRpc\Traits
 */
trait Resource {
	/**
	 * @var string
	 */
	protected $resource = "";

	/**
	 * @return string
	 */
	public function getResource() {
		return $this->resource;
	}

	/**
	 * @param string $resource
	 *
	 * @return $this
	 */
	public function setResource($resource) {
		if (!is_string($resource) || !strlen($resource)) {
			throw new \Error('', 0);
		}
		$this->resource = $resource;

		return $this;
	}
}
