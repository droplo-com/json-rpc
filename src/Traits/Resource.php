<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
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
		$this->resource = $resource;

		return $this;
	}
}
