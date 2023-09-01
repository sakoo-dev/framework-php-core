<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert;

use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\Assert\Traits\BooleanType;
use Sakoo\Framework\Core\Assert\Traits\CallableType;
use Sakoo\Framework\Core\Assert\Traits\FileType;
use Sakoo\Framework\Core\Assert\Traits\GeneralType;
use Sakoo\Framework\Core\Assert\Traits\NullType;
use Sakoo\Framework\Core\Assert\Traits\NumberType;
use Sakoo\Framework\Core\Assert\Traits\ObjectType;
use Sakoo\Framework\Core\Assert\Traits\ResourceType;
use Sakoo\Framework\Core\Assert\Traits\ScalarType;
use Sakoo\Framework\Core\Assert\Traits\StringType;
use Sakoo\Framework\Core\Assert\Traits\TraversableType;

class Assert
{
	use BooleanType;
	use CallableType;
	use FileType;
	use GeneralType;
	use NullType;
	use NumberType;
	use ObjectType;
	use ResourceType;
	use ScalarType;
	use StringType;
	use TraversableType;

	private static function throwIf(bool $condition, string $message = ''): void
	{
		static::throwUnless(!$condition, $message);
	}

	private static function throwUnless(bool $condition, string $message = ''): void
	{
		$condition ?: throw new InvalidArgumentException($message);
	}
}
