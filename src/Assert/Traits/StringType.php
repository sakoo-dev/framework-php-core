<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Variable\Variable;

trait StringType
{
	public static function string(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not string', Variable::stringify($value));
		static::throwUnless(is_string($value), $message);
	}

	public static function notString(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is string', Variable::stringify($value));
		static::throwIf(is_string($value), $message);
	}
}
