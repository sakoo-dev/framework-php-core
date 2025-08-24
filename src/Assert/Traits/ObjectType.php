<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Str\Str;

trait ObjectType
{
	public static function object(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not an object', Str::fromType($value));
		static::throwUnless(is_object($value), $message);
	}

	public static function notObject(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an object', Str::fromType($value));
		static::throwIf(is_object($value), $message);
	}

	public static function instanceOf(mixed $value, string $class, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not instance of %s', Str::fromType($value), $class);
		static::throwUnless((is_string($value) || is_object($value)) && is_subclass_of($value, $class), $message);
	}

	public static function notInstanceOf(mixed $value, string $class, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is instance of %s', Str::fromType($value), $class);
		static::throwIf((is_string($value) || is_object($value)) && is_subclass_of($value, $class), $message);
	}
}
