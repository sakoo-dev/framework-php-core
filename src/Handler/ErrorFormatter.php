<?php

namespace Sakoo\Framework\Core\Handler;

class ErrorFormatter
{
	public function __construct(
		private $errorNumber,
		private $errorString,
		private $errorFile,
		private $errorLine,
	) {
	}

	public function __toString()
	{
		// debug_backtrace();
		return "[$this->errorNumber] $this->errorString at $this->errorFile line $this->errorLine" . PHP_EOL;
	}
}
