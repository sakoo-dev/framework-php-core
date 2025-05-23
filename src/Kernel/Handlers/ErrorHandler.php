<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel\Handlers;

class ErrorHandler
{
	public function __invoke(string $errorNumber, string $errorString, string $errorFile, string $errorLine): never
	{
		debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);

		exit("[$errorNumber] $errorString at $errorFile line $errorLine" . PHP_EOL);
	}
}
