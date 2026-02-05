<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Str\Str;

trait ResourceType
{
	public static function resource(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a resource', Str::fromType($value));
		static::throwUnless(is_resource($value), $message);
	}

	public static function notResource(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a resource', Str::fromType($value));
		static::throwIf(is_resource($value), $message);
	}
}
