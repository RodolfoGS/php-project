<?php

namespace system;

class Route
{

	private $name;

	private $method;

	private $pattern;

	private $action;

	private $arguments;

	public function getAction()
	{
		return $this->action;
	}

	public function getArguments()
	{
		return $this->arguments;
	}

	public function match(Request $request)
	{
		if ((in_array('*', $this->method) !== false ||
				in_array($request->getMethod(), $this->method) !== false) &&
				preg_match($this->getRegex(), $request->getUrl(), $arguments) !== 0) {
			array_shift($arguments);
			$this->arguments = $arguments;
			return true;
		}
	}

	public static function createFromArray(Array $array = array())
	{
		$route = new self;

		$route->name = (string) @$array['name'];
		$route->method = array_map(function ($method) {
			return strtoupper($method);
		}, (array) @$array['method']);
		$route->pattern = (string) @$array['pattern'];
		$route->action = (string) @$array['action'];

		return $route;
	}

	/**
	 * Crea una expresion regular en base a la notacion del patron de rutas
	 *
	 * @return string Expresion regular para matchear
	 */
	private function getRegex()
	{
		$regex = '@^' . preg_replace_callback(
			'/{(\?)?(int|string):([a-z]+)}/',
			function ($matches) {
				list(, $noRef, $type) = $matches;
				$data = str_replace(
					array('int', 'string'),
					array('\d+?', '.+?'),
					$type
				);
				if (!$noRef) {
					$data = '(' . $data . ')';
				}
				return $data;
			},
			$this->pattern
		) . '$@';
		return $regex;
	}

}