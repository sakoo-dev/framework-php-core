<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert;

/**
 * @method AssertionChain true(string $message = '')
 * @method AssertionChain false(string $message = '')
 * @method AssertionChain bool(string $message = '')
 * @method AssertionChain notBool(string $message = '')
 * @method AssertionChain callable(string $message = '')
 * @method AssertionChain notCallable(string $message = '')
 * @method AssertionChain dir(string $message = '')
 * @method AssertionChain notDir(string $message = '')
 * @method AssertionChain file(string $message = '')
 * @method AssertionChain notFile(string $message = '')
 * @method AssertionChain link(string $message = '')
 * @method AssertionChain notLink(string $message = '')
 * @method AssertionChain uploadedFile(string $message = '')
 * @method AssertionChain notUploadedFile(string $message = '')
 * @method AssertionChain executableFile(string $message = '')
 * @method AssertionChain notExecutableFile(string $message = '')
 * @method AssertionChain writableFile(string $message = '')
 * @method AssertionChain notWritableFile(string $message = '')
 * @method AssertionChain readableFile(string $message = '')
 * @method AssertionChain notReadableFile(string $message = '')
 * @method AssertionChain exists(string $message = '')
 * @method AssertionChain notExists(string $message = '')
 * @method AssertionChain length(int $length, string $message = '')
 * @method AssertionChain count(array|\int $count, string $message = '')
 * @method AssertionChain equals(mixed $expected, string $message = '')
 * @method AssertionChain notEquals(mixed $expected, string $message = '')
 * @method AssertionChain same(mixed $expected, string $message = '')
 * @method AssertionChain notSame(mixed $expected, string $message = '')
 * @method AssertionChain empty(string $message = '')
 * @method AssertionChain notEmpty(string $message = '')
 * @method AssertionChain null(string $message = '')
 * @method AssertionChain notNull(string $message = '')
 * @method AssertionChain numeric(string $message = '')
 * @method AssertionChain notNumeric(string $message = '')
 * @method AssertionChain finite(string $message = '')
 * @method AssertionChain infinite(string $message = '')
 * @method AssertionChain float(string $message = '')
 * @method AssertionChain notFloat(string $message = '')
 * @method AssertionChain int(string $message = '')
 * @method AssertionChain notInt(string $message = '')
 * @method AssertionChain greater(int $expected, string $message = '')
 * @method AssertionChain greaterOrEquals(int $expected, string $message = '')
 * @method AssertionChain lower(int $expected, string $message = '')
 * @method AssertionChain lowerOrEquals(int $expected, string $message = '')
 * @method AssertionChain object(string $message = '')
 * @method AssertionChain notObject(string $message = '')
 * @method AssertionChain instanceOf(string $class, string $message = '')
 * @method AssertionChain notInstanceOf(string $class, string $message = '')
 * @method AssertionChain resource(string $message = '')
 * @method AssertionChain notResource(string $message = '')
 * @method AssertionChain scalar(string $message = '')
 * @method AssertionChain notScalar(string $message = '')
 * @method AssertionChain string(string $message = '')
 * @method AssertionChain notString(string $message = '')
 * @method AssertionChain array(string $message = '')
 * @method AssertionChain notArray(string $message = '')
 * @method AssertionChain countable(string $message = '')
 * @method AssertionChain notCountable(string $message = '')
 * @method AssertionChain iterable(string $message = '')
 * @method AssertionChain notIterable(string $message = '')
 */
class AssertionChain
{
	public function __construct(private mixed $value = null) {}

	public function __call(string $name, array $arguments)
	{
		array_unshift($arguments, $this->value);
		call_user_func_array([Assert::class, $name], $arguments);

		return $this;
	}
}
