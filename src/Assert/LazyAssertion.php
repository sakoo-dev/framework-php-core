<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert;

use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\Assert\Exception\LazyAssertionException;
use Sakoo\Framework\Core\Doc\Attributes\DontDocument;

/**
 * @method LazyAssertion true(mixed $value, string $message = '')
 * @method LazyAssertion false(mixed $value, string $message = '')
 * @method LazyAssertion bool(mixed $value, string $message = '')
 * @method LazyAssertion notBool(mixed $value, string $message = '')
 * @method LazyAssertion callable(mixed $value, string $message = '')
 * @method LazyAssertion notCallable(mixed $value, string $message = '')
 * @method LazyAssertion dir(string $value, string $message = '')
 * @method LazyAssertion notDir(string $value, string $message = '')
 * @method LazyAssertion file(string $value, string $message = '')
 * @method LazyAssertion notFile(string $value, string $message = '')
 * @method LazyAssertion link(string $value, string $message = '')
 * @method LazyAssertion notLink(string $value, string $message = '')
 * @method LazyAssertion uploadedFile(string $value, string $message = '')
 * @method LazyAssertion notUploadedFile(string $value, string $message = '')
 * @method LazyAssertion executableFile(string $value, string $message = '')
 * @method LazyAssertion notExecutableFile(string $value, string $message = '')
 * @method LazyAssertion writableFile(string $value, string $message = '')
 * @method LazyAssertion notWritableFile(string $value, string $message = '')
 * @method LazyAssertion readableFile(string $value, string $message = '')
 * @method LazyAssertion notReadableFile(string $value, string $message = '')
 * @method LazyAssertion exists(string $value, string $message = '')
 * @method LazyAssertion notExists(string $value, string $message = '')
 * @method LazyAssertion length(string $value, int $length, string $message = '')
 * @method LazyAssertion count(array|\Countable $value, int $count, string $message = '')
 * @method LazyAssertion equals(mixed $value, mixed $expected, string $message = '')
 * @method LazyAssertion notEquals(mixed $value, mixed $expected, string $message = '')
 * @method LazyAssertion same(mixed $value, mixed $expected, string $message = '')
 * @method LazyAssertion notSame(mixed $value, mixed $expected, string $message = '')
 * @method LazyAssertion empty(mixed $value, string $message = '')
 * @method LazyAssertion notEmpty(mixed $value, string $message = '')
 * @method LazyAssertion null(mixed $value, string $message = '')
 * @method LazyAssertion notNull(mixed $value, string $message = '')
 * @method LazyAssertion numeric(mixed $value, string $message = '')
 * @method LazyAssertion notNumeric(mixed $value, string $message = '')
 * @method LazyAssertion finite(float $value, string $message = '')
 * @method LazyAssertion infinite(float $value, string $message = '')
 * @method LazyAssertion float(mixed $value, string $message = '')
 * @method LazyAssertion notFloat(mixed $value, string $message = '')
 * @method LazyAssertion int(mixed $value, string $message = '')
 * @method LazyAssertion notInt(mixed $value, string $message = '')
 * @method LazyAssertion greater(int $value, int $expected, string $message = '')
 * @method LazyAssertion greaterOrEquals(int $value, int $expected, string $message = '')
 * @method LazyAssertion lower(int $value, int $expected, string $message = '')
 * @method LazyAssertion lowerOrEquals(int $value, int $expected, string $message = '')
 * @method LazyAssertion object(mixed $value, string $message = '')
 * @method LazyAssertion notObject(mixed $value, string $message = '')
 * @method LazyAssertion instanceOf(mixed $value, string $class, string $message = '')
 * @method LazyAssertion notInstanceOf(mixed $value, string $class, string $message = '')
 * @method LazyAssertion resource(mixed $value, string $message = '')
 * @method LazyAssertion notResource(mixed $value, string $message = '')
 * @method LazyAssertion scalar(mixed $value, string $message = '')
 * @method LazyAssertion notScalar(mixed $value, string $message = '')
 * @method LazyAssertion string(mixed $value, string $message = '')
 * @method LazyAssertion notString(mixed $value, string $message = '')
 * @method LazyAssertion array(mixed $value, string $message = '')
 * @method LazyAssertion notArray(mixed $value, string $message = '')
 * @method LazyAssertion countable(mixed $value, string $message = '')
 * @method LazyAssertion notCountable(mixed $value, string $message = '')
 * @method LazyAssertion iterable(mixed $value, string $message = '')
 * @method LazyAssertion notIterable(mixed $value, string $message = '')
 */
// @phpstan-ignore missingType.iterableValue
#[DontDocument]
class LazyAssertion
{
	/**
	 * @phpstan-var  array<string,array<int,InvalidArgumentException>> $exceptions
	 */
	private array $exceptions = [];
	private string $chainName = '';
	private object|string $currentChain = Assert::class;

	public function __construct() {}

	/**
	 * @param array<mixed> $arguments
	 */
	public function __call(string $name, array $arguments): static
	{
		try {
			// @phpstan-ignore argument.type
			call_user_func_array([$this->currentChain, $name], $arguments);
		} catch (InvalidArgumentException $e) {
			$this->exceptions[$this->chainName][] = $e;
		}

		return $this;
	}

	/**
	 * @return AssertionChain
	 *
	 * @phpstan-ignore return.phpDocType
	 */
	public function that(mixed $value, string $chainName): static
	{
		$this->chainName = $chainName;
		$this->currentChain = Assert::that($value);

		return $this;
	}

	/**
	 * @throws LazyAssertionException
	 */
	public function validate(): void
	{
		if (!empty($this->exceptions)) {
			throw LazyAssertionException::init($this->exceptions);
		}
	}
}
