<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait BooleanType
{
	public static function true(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not true', new VarDump($value));
		static::throwUnless(true === $value, $message);
	}

	public static function false(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not false', new VarDump($value));
		static::throwUnless(false === $value, $message);
	}

	public static function bool(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not boolean', new VarDump($value));
		static::throwUnless(is_bool($value), $message);
	}

	public static function notBool(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is boolean', new VarDump($value));
		static::throwIf(is_bool($value), $message);
	}
}
