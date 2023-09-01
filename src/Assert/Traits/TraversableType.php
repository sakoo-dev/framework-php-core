<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Variable\Variable;

trait TraversableType
{
	public static function array(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not an array', Variable::stringify($value));
		static::throwUnless(is_array($value), $message);
	}

	public static function notArray(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an array', Variable::stringify($value));
		static::throwIf(is_array($value), $message);
	}

	public static function countable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not countable', Variable::stringify($value));
		static::throwUnless(is_countable($value), $message);
	}

	public static function notCountable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is countable', Variable::stringify($value));
		static::throwIf(is_countable($value), $message);
	}

	public static function iterable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not iterable', Variable::stringify($value));
		static::throwUnless(is_iterable($value), $message);
	}

	public static function notIterable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is iterable', Variable::stringify($value));
		static::throwIf(is_iterable($value), $message);
	}
}
