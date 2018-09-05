<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;

use JsonRpc\Traits\Method;
use JsonRpc\Traits\Params;
use JsonRpc\Traits\Resource;

/**
 * Class Notification
 * @package JsonRpc
 */
class Notification extends JsonRpc {
	use Resource;
	use Method;
	use Params;

	/**
	 * Notification constructor.
	 *
	 * @param array|null $data
	 */
	public function __construct(array $data = null) {
		$this->type = 'Notification';
		if (is_array($data)) {
			isset($data['resource']) && $this->setResource($data['resource']);
			isset($data['method']) && $this->setMethod($data['method']);
			isset($data['params']) && $this->setParams($data['params']);
		}
	}
}
