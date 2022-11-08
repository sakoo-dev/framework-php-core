<?php

namespace Sakoo\Framework\Core\Logger;

use Sakoo\Framework\Core\DateTime\DateTime;

class LogFormatter
{
	public function __construct(
		private string $level,
		private string $message,
		private string $mode,
		private string $env,
	) {
	}

	public function __toString()
	{
		return DateTime::getNow('Y-m-d H:i:s') . " - $this->mode $this->env - " . strtoupper($this->level) . " - $this->message";
	}
}
