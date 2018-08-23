<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
class JSONLess {
	static private $handlers = [];

	/**
	 * @param $string
	 *
	 * @return array
	 */
	static function parse($string) {
		if (is_string($string) && strlen($string)) {
			$value = \json_decode($string, true);
		} else {
			$value = $string;
		}

		return self::reviver($value);
	}

	/**
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	static function reviver($value) {
		if (is_array($value)) {
			if (isset($value['$type']) && isset(self::$handlers[$value['$type']])) {
				return self::$handlers[$value['$type']]['reviver']($value);
			}

			return array_map(function ($value) {
				return self::reviver($value);
			}, $value);
		}

		return $value;
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	static function stringify($value) {
		return json_encode(self::replacer($value));
	}

	/**
	 * @param mixed $value
	 *
	 * @return mixed
	 */
	static function replacer($value) {
		if (is_object($value)) {
			$name = get_class($value);
			if (isset(self::$handlers[$name])) {
				return [
					'$type' => $name,
					'$value' => self::$handlers[$name]['replacer']($value)
				];
			}
		}
		if (is_array($value)) {
			return array_map(function ($value) {
				return self::replacer($value);
			}, $value);
		}

		return $value;
	}

	/**
	 * @param $class
	 * @param $replacer
	 * @param $reviver
	 */
	static function addHandler($class, $replacer, $reviver) {
		self::$handlers[$class] = [
			'reviver' => $reviver,
			'replacer' => $replacer
		];
	}
}

JSONLess::addHandler('DateTime', function ($value) {
	return $value->format(DATE_RFC3339_EXTENDED);
}, function ($value) {
	return new \DateTime($value['$value']);
});
