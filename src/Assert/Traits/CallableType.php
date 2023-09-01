<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Variable\Variable;

trait CallableType
{
	public static function callable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not callable', Variable::stringify($value));
		static::throwUnless(is_callable($value), $message);
	}

	public static function notCallable(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is callable', Variable::stringify($value));
		static::throwIf(is_callable($value), $message);
	}
}
