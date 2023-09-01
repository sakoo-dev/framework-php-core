<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Handler;

class ExceptionHandler
{
	public function __invoke($exception)
	{
		throw $exception;
	}
}
