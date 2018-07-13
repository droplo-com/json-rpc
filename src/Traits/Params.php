<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
/**
 * Trait Params
 * @package JsonRpc\Traits
 */
trait Params {
	/**
	 * @var array
	 */
	protected $params = [];

	/**
	 * @return array
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * @param array $params
	 *
	 * @return $this
	 */
	public function setParams($params) {
		if (!is_array($params)) {
			throw new \Error('$params must be array', 0);
		}
		$this->params = $params;

		return $this;
	}
}
