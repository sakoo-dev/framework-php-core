<?php

namespace Sakoo\Framework\Core\Handler;

class ErrorHandler
{
	public function __invoke($errorNumber, $errorString, $errorFile, $errorLine)
	{
		echo new ErrorFormatter($errorNumber, $errorString, $errorFile, $errorLine);
	}
}
