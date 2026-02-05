<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Exception;

use Sakoo\Framework\Core\Doc\Attributes\DontDocument;
use Sakoo\Framework\Core\Exception\Exception;

class LazyAssertionException extends Exception
{
	#[DontDocument]
	public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @phpstan-param array<string,array<int,InvalidArgumentException>> $exceptions
	 */
	public static function init(array $exceptions): self
	{
		/**
		 * @phpstan-ignore staticClassAccess.privateMethod
		 */
		$message = static::getLazyMessage($exceptions);

		return new self($message);
	}

	/**
	 * @phpstan-param array<string,array<int,InvalidArgumentException>> $value
	 */
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
