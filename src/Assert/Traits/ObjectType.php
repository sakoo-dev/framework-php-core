<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait ObjectType
{
	public static function object(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not an object', new VarDump($value));
		static::throwUnless(is_object($value), $message);
	}

	public static function notObject(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an object', new VarDump($value));
		static::throwIf(is_object($value), $message);
	}

	public static function instanceOf(mixed $value, string $class, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is not instance of %s',
			new VarDump($value),
			new VarDump($class),
		);

		static::throwUnless(is_subclass_of($value, $class), $message);
	}

	public static function notInstanceOf(mixed $value, string $class, string $message = ''): void
	{
		$message = $message ?: sprintf(
			'Given value %s is instance of %s',
			new VarDump($value),
			new VarDump($class),
		);

		static::throwIf(is_subclass_of($value, $class), $message);
	}
}
