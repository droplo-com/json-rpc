<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
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
		$this->params = $params;

		return $this;
	}
}
