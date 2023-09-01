<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Variable\Variable;

trait ScalarType
{
	public static function scalar(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not scalar', Variable::stringify($value));
		static::throwUnless(is_scalar($value), $message);
	}

	public static function notScalar(mixed $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is scalar', Variable::stringify($value));
		static::throwIf(is_scalar($value), $message);
	}
}
