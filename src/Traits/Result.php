<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
trait Result {
	/**
	 * @var string
	 */
	protected $result;

	/**
	 * @return string
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param string $result
	 *
	 * @return $this
	 */
	public function setResult($result) {
		$this->type = 'Response';
		$this->result = $result;

		return $this;
	}
}
