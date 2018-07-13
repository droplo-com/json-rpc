<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
const FIELDS = [
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
 * Class JsonRpc
 * @package JsonRpc
 */
class JsonRpc {
	/**
	 * @var string
	 */
	public static $version = '1.2.0';
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
		foreach (FIELDS as $name => $fields) {
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
		if (count($array) !== count($fields)) {
			return false;
		}
		foreach ($fields as $field) {
			if (!isset($array[$field])) {
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
		$exports = ['version' => self::$version];
		foreach (FIELDS[$this->type] as $key) {
			$this->throwIfNull($key, new \Error("Missing property '$key'", 0));
			$exports[$key] = $this->$key;
		}

		return Serializer::serialize($exports);
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
