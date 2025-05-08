<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

class Input
{
	public function __construct(private array $args = []) {}

	public function getArgs(): array
	{
		return $this->args;
	}

	public function getSwitches(): array
	{
		$result = [];

		foreach ($this->args as $arg) {
			if (str_starts_with($arg, '--')) {
				$result[] = $arg;
			}
		}

		return $result;
	}
}
