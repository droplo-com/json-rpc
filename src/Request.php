<?php
/**
 * @author Michał Żaloudik <ponury.kostek@gmail.com>
 */

namespace JsonRpc;



/**
 * Class Request
 * @package JsonRpc
 */
class Request extends JsonRpc {
	use Traits\Id;
	use Traits\Method;
	use Traits\Params;
	use Traits\Resource;

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
