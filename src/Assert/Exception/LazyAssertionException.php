<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Exception;

use Sakoo\Framework\Core\Exception\Exception;

class LazyAssertionException extends Exception
{
	private array $exceptions = [];

	public function getExceptions(): array
	{
		return $this->exceptions;
	}

	public function setExceptions(array $value): void
	{
		foreach ($value as $chain) {
			foreach ($chain as $message) {
				$this->exceptions[] = $message;
			}
		}
	}
}
