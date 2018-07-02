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
		return json_encode($data);
	}

	/**
	 * @param string $data
	 *
	 * @return mixed
	 */
	public static function deserialize($data) {
		return json_decode($data, true);
	}
}
