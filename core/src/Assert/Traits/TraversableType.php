<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Str\Str;

trait TraversableType
{
	public static function array(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not an array', Str::fromType($value));
		static::throwUnless(is_array($value), $message);
	}

	public static function notArray(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an array', Str::fromType($value));
		static::throwIf(is_array($value), $message);
	}

	public static function countable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not countable', Str::fromType($value));
		static::throwUnless(is_countable($value), $message);
	}

	public static function notCountable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is countable', Str::fromType($value));
		static::throwIf(is_countable($value), $message);
	}

	public static function iterable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not iterable', Str::fromType($value));
		static::throwUnless(is_iterable($value), $message);
	}

	public static function notIterable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is iterable', Str::fromType($value));
		static::throwIf(is_iterable($value), $message);
	}
}
