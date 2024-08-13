<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait GeneralType
{
	public static function length(string $value, int $length, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'The length of %s is %s, Expected %s',
			new VarDump($value),
			new VarDump(strlen($value)),
			new VarDump($length),
		);

		static::same($length, mb_strlen($value), $message);
	}

	public static function count(array|\Countable $value, int $count, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'The count of %s is %s, Expected %s',
			new VarDump($value),
			new VarDump(count($value)),
			new VarDump($count),
		);

		static::same($count, count($value), $message);
	}

	public static function equals(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is not equals to %s',
			new VarDump($value),
			new VarDump($expected),
		);

		static::throwUnless($value == $expected, $message);
	}

	public static function notEquals(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is equals to %s',
			new VarDump($value),
			new VarDump($expected),
		);

		static::throwIf($value == $expected, $message);
	}

	public static function same(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is not same to %s',
			new VarDump($value),
			new VarDump($expected),
		);

		static::throwUnless($value === $expected, $message);
	}

	public static function notSame(mixed $value, mixed $expected, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is same to %s',
			new VarDump($value),
			new VarDump($expected),
		);

		static::throwIf($value === $expected, $message);
	}

	public static function empty(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not empty', new VarDump($value));
		static::throwUnless(empty($value), $message);
	}

	public static function notEmpty(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is empty', new VarDump($value));
		static::throwIf(empty($value), $message);
	}
}
