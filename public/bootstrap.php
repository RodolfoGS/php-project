<?php

spl_autoload_register(function ($class) {
	require '../' . str_replace('\\', '/', $class) . '.php';
});

system\Request::createFromContext()->run();