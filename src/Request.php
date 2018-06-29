<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;

use JsonRpc\Traits\{
	Id, Method, Params, Resource
};

/**
 * Class Request
 * @package JsonRpc
 */
class Request extends JsonRpc {
	use Id;
	use Resource;
	use Method;
	use Params;

	/**
	 * Request constructor.
	 *
	 * @param array|null $data
	 */
	public function __construct(array $data = null) {
		$this->type = 'Request';
		$this->setId(isset($data['id']) ? $data['id'] : null);
		if (is_array($data)) {
			isset($data['resource']) && $this->setResource($data['resource']);
			isset($data['method']) && $this->setMethod($data['method']);
			isset($data['params']) && $this->setParams($data['params']);
		}
	}
}
