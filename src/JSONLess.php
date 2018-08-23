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
		$reviver = function ($value) use (&$reviver) {
			if (is_array($value)) {
				if (isset($value['$type']) && isset(self::$handlers[$value['$type']])) {
					return self::$handlers[$value['$type']]['reviver']($value);
				}

				return array_map($reviver, $value);
			}

			return $value;
		};
		if (is_string($string) && strlen($string)) {
			$value = \json_decode($string, true);
		} else {
			$value = $string;
		}

		return $reviver($value);
	}

	/**
	 * @param $value
	 *
	 * @return string
	 */
	static function stringify($value) {
		$replacer = function ($value) use (&$replacer) {
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
				return array_map($replacer, $value);
			}

			return $value;
		};

		return json_encode($replacer($value));
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
