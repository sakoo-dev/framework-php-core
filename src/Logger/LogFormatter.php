<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Logger;

use Sakoo\Framework\Core\Clock\Clock;

readonly class LogFormatter
{
	public function __construct(
		private string $level,
		private string $message,
		private string $mode,
		private string $env,
	) {}

	public function __toString()
	{
		$dateTime = (new Clock())->now()->format(\DateTimeInterface::ATOM);

		return "[$dateTime] [" . strtoupper($this->level) . "] [$this->mode $this->env] - $this->message";
	}
}
