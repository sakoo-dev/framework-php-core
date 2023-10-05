<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Variable\Variable;

trait GeneralType
{
	public static function length(string $value, int $length, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'The length of %s is %s, Expected %s',
			Variable::stringify($value),
			Variable::stringify(strlen($value)),
			Variable::stringify($length),
		);

		static::same($length, strlen($value), $message);
	}

	public static function count(array|\Countable $value, int $count, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'The count of %s is %s, Expected %s',
			Variable::stringify($value),
			Variable::stringify(count($value)),
			Variable::stringify($count),
		);

		static::same($count, count($value), $message);
	}

	public static function equals(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is not equals to %s',
			Variable::stringify($value),
			Variable::stringify($expected),
		);

		static::throwUnless($value == $expected, $message);
	}

	public static function notEquals(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is equals to %s',
			Variable::stringify($value),
			Variable::stringify($expected),
		);

		static::throwIf($value == $expected, $message);
	}

	public static function same(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is not same to %s',
			Variable::stringify($value),
			Variable::stringify($expected),
		);

		static::throwUnless($value === $expected, $message);
	}

	public static function notSame(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is same to %s',
			Variable::stringify($value),
			Variable::stringify($expected),
		);

		static::throwIf($value === $expected, $message);
	}

	public static function empty(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not empty', Variable::stringify($value));
		static::throwUnless(empty($value), $message);
	}

	public static function notEmpty(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is empty', Variable::stringify($value));
		static::throwIf(empty($value), $message);
	}
}
