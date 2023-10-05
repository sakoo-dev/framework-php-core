<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert;

use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\Assert\Exception\LazyAssertionException;

/**
 * @method AssertionChain bool(mixed $value)
 */
class LazyAssertion
{
	private array $exceptions = [];
	private string $chainName = '';
	private string|object $currentChain = Assert::class;

	public function __construct()
	{
	}

	public function __call(string $name, array $arguments)
	{
		try {
			call_user_func_array([$this->currentChain, $name], $arguments);
		} catch (InvalidArgumentException $e) {
			$this->exceptions[$this->chainName][] = $e;
		}

		return $this;
	}

	public function that(mixed $value, string $chainName)
	{
		$this->chainName = $chainName;
		$this->currentChain = Assert::that($value);

		return $this;
	}

	public function validate(): void
	{
		if (!empty($this->exceptions)) {
			$message = $this->getLazyMessage($this->exceptions);
			$exception = new LazyAssertionException($message);
			$exception->setExceptions($this->exceptions);

			throw $exception;
		}
	}

	private function getLazyMessage(array $value): string
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
