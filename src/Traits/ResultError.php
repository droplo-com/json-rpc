<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
/**
 * Trait ResultError
 * @package JsonRpc\Traits
 */
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
	 * @param array $error
	 *
	 * @return $this
	 */
	public function setError($error) {
		if (!is_array($error) || /* type */
			!isset($error['message']) || !isset($error['code']) || /* isset */
			!is_string($error['message']) || !is_string($error['code']) || /* type */
			!strlen($error['message']) || !strlen($error['code'])/* length */) {
			throw new \Exception('', 0);
		}
		$this->type = 'ResponseError';
		$this->error = $error;

		return $this;
	}
}
