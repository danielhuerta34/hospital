<?php

class ErrorController
{
	public function __construct()
	{
	}

	public function index()
	{
		Vista::render(
			"error"
		);
	}
}
