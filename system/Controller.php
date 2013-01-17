<?php

namespace system;

abstract class Controller
{

	private $request;


	public function getRequest()
	{
		return $this->request;
	}

	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

}