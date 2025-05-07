<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait NumberType
{
	public static function numeric(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not numeric', new VarDump($value));
		static::throwUnless(is_numeric($value), $message);
	}

	public static function notNumeric(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is numeric', new VarDump($value));
		static::throwIf(is_numeric($value), $message);
	}

	public static function finite(float $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an infinite number', new VarDump($value));
		static::throwUnless(is_finite($value), $message);
	}

	public static function infinite(float $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a finite number', new VarDump($value));
		static::throwUnless(is_infinite($value), $message);
	}

	public static function float(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a float number', new VarDump($value));
		static::throwUnless(is_float($value), $message);
	}

	public static function notFloat(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a float number', new VarDump($value));
		static::throwIf(is_float($value), $message);
	}

	public static function int(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not an integer number', new VarDump($value));
		static::throwUnless(is_int($value), $message);
	}

	public static function notInt(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an integer number', new VarDump($value));
		static::throwIf(is_int($value), $message);
	}

	public static function greater(int $value, int $expected, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not greater than %s', $value, $expected);
		static::throwUnless($value > $expected, $message);
	}

	public static function greaterOrEquals(int $value, int $expected, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not greater or equals to %s', $value, $expected);
		static::throwUnless($value >= $expected, $message);
	}

	public static function lower(int $value, int $expected, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not lower than %s', $value, $expected);
		static::throwUnless($value < $expected, $message);
	}

	public static function lowerOrEquals(int $value, int $expected, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not lower or equals to %s', $value, $expected);
		static::throwUnless($value <= $expected, $message);
	}
}
