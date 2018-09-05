<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
/**
 * Class JsonRpc
 * @package JsonRpc
 */
class JsonRpc {
	/**
	 * @var string
	 */
	public static $version = '1.2.0';
	private static $FIELDS = [
		'Request' => [
			'id',
			'resource',
			'method',
			'params'
		],
		'Notification' => [
			'resource',
			'method',
			'params'
		],
		'Response' => [
			'id',
			'result'
		],
		'ResponseError' => [
			'id',
			'error'
		]
	];
	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @param string|array $message
	 *
	 * @throws \Error
	 * @return Notification|Request|Response
	 */
	public static function parse($message) {
		if (is_string($message)) {
			$message = Serializer::deserialize($message);
		}
		$type = self::getType($message);
		if ($type === 'ResponseError') {
			$type = 'Response';
		}
		if (!$type) {
			throw new \Error('Unknown message type', 0);
		}
		$type = '\\JsonRpc\\' . $type;

		return new $type($message);
	}

	/**
	 * @param $data
	 *
	 * @return string|bool
	 */
	public static function getType($data) {
		foreach (self::$FIELDS as $name => $fields) {
			$fields[] = 'version';
			if (self::hasFields($data, $fields)) {
				return $name;
			}
		}

		return false;
	}

	/**
	 * @param array $array
	 * @param array $fields
	 *
	 * @return bool
	 */
	public static function hasFields($array, $fields) {
		if (!is_array($array) || !is_array($fields)) {
			return false;
		}
		if (count($array) !== count($fields)) {
			return false;
		}
		foreach ($fields as $field) {
			if (!array_key_exists($field, $array)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @throws \Error
	 * @return string
	 */
	public function toString() {
		return Serializer::serialize($this->toJSON());
	}

	/**
	 * @throws \Error
	 * @return array
	 */
	public function toJSON() {
		$exports = ['version' => self::$version];
		foreach (self::$FIELDS[$this->type] as $key) {
			if ($this->type !== 'ResponseError' && $key !== 'id') {
				$this->throwIfNull($key, new \Error("Missing property '$key'", 0));
			}
			$exports[$key] = $this->$key;
		}
		if (isset($exports['params'])) {
			$exports['params'] = (object)$exports['params'];
		}

		return $exports;
	}

	/**
	 * @param $property
	 * @param $error
	 *
	 * @throws
	 */
	public function throwIfNull($property, $error) {
		if (!isset($this->$property)) {
			throw $error;
		}
	}
}
