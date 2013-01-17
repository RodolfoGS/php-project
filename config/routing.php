<?php

return array(

	array(
		'method' => 'get',
		'pattern' => '/?',
		'action' => 'Demo.itWorks'
	),

	array(
		'name' => 'echo',
		'method' => '*',
		'pattern' => '/echo/{string:msg}/?',
		'action' => 'Demo.doEcho'
	)

);