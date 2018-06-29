<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
class JsonRpc {
	/**
	 * @var int
	 */
	protected static $_id = 0;
	/**
	 * @var array
	 */
	protected static $fields = [
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
	public static $version = '1.2.0';
	/**
	 * @var string
	 */
	protected $type;

	/**
	 * @throws \Error
	 * @return string
	 */
	public function toString() {
		$exports = ['version' => self::$version];
		foreach (self::$fields[$this->type] as $key) {
			$this->throwIfNull($key, new \Error("Missing property '$key'", 0));
			$exports[$key] = $this->$key;
		}

		return Serializer::serialize($exports);
	}

	/**
	 * @param $string
	 *
	 * @throws \Error
	 * @return Notification|Request|Response
	 */
	public static function parse($string) {
		$data = Serializer::deserialize($string);
		$type = self::getType($data);
		if (!$type) {
			throw new \Error('', 0);
		}

		return new $type($data);
	}

	/**
	 * @param $data
	 *
	 * @return string|bool
	 */
	public static function getType($data) {
		foreach (self::$fields as $name => $fields) {
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
	protected static function hasFields($array, $fields) {
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
	 * @param $property
	 * @param $error
	 *
	 * @throws
	 */
	protected function throwIfNull($property, $error) {
		if (!isset($this->$property)) {
			throw $error;
		}
	}
}
