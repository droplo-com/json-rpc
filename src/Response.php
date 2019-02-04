<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;



/**
 * Class Response
 * @package JsonRpc
 */
class Response extends JsonRpc {
	use Traits\Id;
	use Traits\Result;
	use Traits\ResultError;

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

	/**
	 * @throws \Exception
	 * @return string
	 */
	public function toString() {
		$this->throwIfNull('id', new \Exception("Missing property 'id'"));
		$exports = [
			'version' => self::$version,
			'id' => $this->id
		];
		if ($this->type === 'ResponseError') {
			$this->throwIfNull('error', new \Exception("Missing property 'error'"));
			$exports['error'] = $this->error;
		} else {
			$exports['result'] = $this->result;
		}

		return Serializer::serialize($exports);
	}
}
