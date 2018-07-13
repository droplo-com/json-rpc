# JsonRpc
[![Build Status](https://travis-ci.org/etk-pl/json-rpc.svg?branch=master)](https://travis-ci.org/etk-pl/json-rpc)
[![Coverage Status](https://coveralls.io/repos/github/etk-pl/json-rpc/badge.svg?branch=master)](https://coveralls.io/github/etk-pl/json-rpc?branch=master)
[![Maintainability](https://api.codeclimate.com/v1/badges/919defed6cf8c11e01f8/maintainability)](https://codeclimate.com/github/etk-pl/json-rpc/maintainability)

## Example
```php
use JsonRpc\Client;
use JsonRpc\Request;
$client = new Client('http://localhost:8080/');
$response = $client->send(new Request([
	'resource' => 'Test',
	'method' => 'echo',
	'params' => ['param' => 'value']
]));
if($error = $response->getError()) {
	die("Got error: " . $error['message']);
}
$result = $response->getResult();
var_dump($result);
```
