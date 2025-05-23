<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel\Handlers;

class ErrorHandler
{
	public function __invoke(string $errorNumber, string $errorString, string $errorFile, string $errorLine): never
	{
		exit("[$errorNumber] $errorString at $errorFile line $errorLine" . PHP_EOL);
	}
}
