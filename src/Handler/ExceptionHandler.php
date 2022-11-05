<?php

namespace Sakoo\Framework\Core\Handler;

class ExceptionHandler
{
	public function __invoke($exception)
	{
		// debug_backtrace();
		throw $exception;
	}
}
