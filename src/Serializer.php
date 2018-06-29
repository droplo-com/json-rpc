<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;
class Serializer {
	/**
	 * @param $data
	 *
	 * @return string
	 */
	public static function serialize($data) {
		return json_encode($data);
	}

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public static function deserialize($data) {
		return json_decode($data, true);
	}
}
