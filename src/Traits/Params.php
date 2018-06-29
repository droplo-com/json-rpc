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
	 * @var string
	 */
	protected $params = [];

	/**
	 * @return string
	 */
	public function getParams() {
		return $this->params;
	}

	/**
	 * @param string $params
	 *
	 * @return $this
	 */
	public function setParams($params) {
		if (!is_array($params)) {
			throw new \Error('', 0);
		}
		$this->params = $params;

		return $this;
	}
}
