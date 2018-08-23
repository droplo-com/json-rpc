<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
/**
 * Class Serializer
 * @package JsonRpc
 */
class Serializer {
	/**
	 * @param mixed $data
	 *
	 * @return string
	 */
	public static function serialize($data) {
		return JSONLess::stringify($data);
	}

	/**
	 * @param string $data
	 *
	 * @return mixed
	 */
	public static function deserialize($data) {
		return JSONLess::parse($data);
	}
}
