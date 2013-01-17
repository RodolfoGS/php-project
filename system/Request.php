<?php

namespace system;

class Request
{

	private $method;

	private $url;

	public function getMethod()
	{
		return $this->method;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function run()
	{
		$routes = Config::routing();
		foreach ($routes as $route) {
			if ($route->match($this)) {
				list($class, $method) = explode('.', $route->getAction());
				if (strpos($class, '\\') !== 0) {
					$class = '\controller\\' . $class;
				}
				$controller = new $class;
				$controller->setRequest($this);
				return call_user_func_array(
					array($controller, $method),
					$route->getArguments()
				);
			}
		}
		throw new \exception\http\NotFound;
	}

	public static function createFromArray(Array $array = array())
	{
		$request = new self;

		$request->method = strtoupper((string) @$array['method']);
		$request->url = (string) @$array['url'];

		return $request;
	}


	public static function createFromContext()
	{
		return self::createFromArray(array(
			'method' => @$_SERVER['REQUEST_METHOD'],
			'url' => @$_SERVER['PATH_INFO']
		));
	}

}