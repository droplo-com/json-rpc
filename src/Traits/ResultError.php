<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
trait ResultError {
	/**
	 * @var string
	 */
	protected $error;

	/**
	 * @return string
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * @param string $error
	 *
	 * @return $this
	 */
	public function setError($error) {
		$this->type = 'ResponseError';
		$this->error = $error;

		return $this;
	}
}
