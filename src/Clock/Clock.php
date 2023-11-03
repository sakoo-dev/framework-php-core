<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Clock;

use Psr\Clock\ClockInterface;
use Sakoo\Framework\Core\Clock\Exceptions\ClockTestModeException;

class Clock implements ClockInterface
{
	private static string $testNow = 'now';

	public static function setTestNow(string $datetime = 'now'): void
	{
		throwUnless(kernel()->isInTestMode(), new ClockTestModeException());
		static::$testNow = $datetime;
	}

	/**
	 * @throws \Exception
	 */
	public function now(): \DateTimeImmutable
	{
		return new \DateTimeImmutable(static::$testNow);
	}
}
