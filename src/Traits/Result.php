<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
/**
 * Trait Result
 * @package JsonRpc\Traits
 */
trait Result {
	/**
	 * @var string
	 */
	protected $result;

	/**
	 * @return mixed
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param mixed $result
	 *
	 * @return $this
	 */
	public function setResult($result) {
		$this->type = 'Response';
		$this->result = $result;

		return $this;
	}
}
