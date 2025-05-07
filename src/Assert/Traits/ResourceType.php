<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait ResourceType
{
	public static function resource(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a resource', new VarDump($value));
		static::throwUnless(is_resource($value), $message);
	}

	public static function notResource(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a resource', new VarDump($value));
		static::throwIf(is_resource($value), $message);
	}
}
