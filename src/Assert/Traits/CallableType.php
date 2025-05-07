<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\VarDump\VarDump;

trait CallableType
{
	public static function callable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not callable', new VarDump($value));
		static::throwUnless(is_callable($value), $message);
	}

	public static function notCallable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is callable', new VarDump($value));
		static::throwIf(is_callable($value), $message);
	}
}
