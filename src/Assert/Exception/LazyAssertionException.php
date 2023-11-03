<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Exception;

use Sakoo\Framework\Core\Exception\Exception;

class LazyAssertionException extends Exception
{
	private function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

	public static function init(array $exceptions): static
	{
		$message = static::getLazyMessage($exceptions);

		return new static($message);
	}

	private static function getLazyMessage(array $value): string
	{
		$result = 'The following assertions failed:' . PHP_EOL;
		$i = 1;

		foreach ($value as $chainName => $chain) {
			foreach ($chain as $message) {
				$result .= "$i) $chainName: {$message->getMessage()}" . PHP_EOL;
				++$i;
			}
		}

		return $result;
	}
}
