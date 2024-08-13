<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait NullType
{
	public static function null(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not null', new VarDump($value));
		static::throwUnless(is_null($value), $message);
	}

	public static function notNull(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is null', new VarDump($value));
		static::throwIf(is_null($value), $message);
	}
}
