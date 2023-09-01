<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Variable\Variable;

trait BooleanType
{
	public static function true(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not true', Variable::stringify($value));
		static::throwUnless(true === $value, $message);
	}

	public static function false(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not false', Variable::stringify($value));
		static::throwUnless(false === $value, $message);
	}

	public static function bool(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not boolean', Variable::stringify($value));
		static::throwUnless(is_bool($value), $message);
	}

	public static function notBool(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is boolean', Variable::stringify($value));
		static::throwIf(is_bool($value), $message);
	}
}
