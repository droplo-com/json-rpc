<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;

use JsonRpc\Traits\{
	Id, Result, ResultError
};

class Response extends JsonRpc {
	use Id;
	use Result;
	use ResultError;

	/**
	 * Result constructor.
	 *
	 * @param array|null $data
	 */
	public function __construct(array $data = null) {
		$this->type = 'Response';
		if (is_array($data)) {
			isset($data['id']) && $this->setId($data['id']);
			isset($data['result']) && $this->setResult($data['result']);
			isset($data['error']) && $this->setError($data['error']);
		}
	}
}
