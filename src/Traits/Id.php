<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc\Traits;
/**
 * Trait Id
 * @package JsonRpc\Traits
 */
trait Id {
	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param integer $id
	 *
	 * @return $this
	 */
	public function setId($id) {
		if(is_null($id)) {
			$this->id = ++self::$_id;
			return $this;
		}
		if (!is_numeric($id)) {
			throw new \Error('', 0);
		}
		$this->id = (int)$id;

		return $this;
	}
}
