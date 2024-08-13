<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Handler;

class ErrorHandler
{
	public function __invoke($errorNumber, $errorString, $errorFile, $errorLine)
	{
		dd((string) new ErrorFormatter($errorNumber, $errorString, $errorFile, $errorLine));
	}
}
