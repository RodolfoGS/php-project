<?php

namespace system;

class Config
{

	private static $routes = null;

	public static function routing()
	{
		if (self::$routes === null) {
			self::$routes = array();
			$routes = require '../config/routing.php';
			foreach ($routes as $route) {
				self::$routes[] = Route::createFromArray($route);
			}
		}
		return self::$routes;
	}

}