<?php

namespace controller;
use system\Controller;

class Demo extends Controller
{

	public function doEcho($message)
	{
		echo htmlspecialchars($message);
	}


	public function itWorks()
	{
		echo '<h1>It works!</h1>';
	}

}