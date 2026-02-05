<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Clock;

use Psr\Clock\ClockInterface;
use Sakoo\Framework\Core\Clock\Exceptions\ClockTestModeException;

class Clock implements ClockInterface
{
	private static string $testNow = 'now';

	/**
	 * @throws ClockTestModeException|\Throwable
	 */
	public static function setTestNow(string $datetime = 'now'): void
	{
		throwUnless(kernel()->isInTestMode(), new ClockTestModeException());
		self::$testNow = $datetime;
	}

	/**
	 * @throws \Exception
	 */
	public function now(): \DateTimeImmutable
	{
		return new \DateTimeImmutable(self::$testNow);
	}
}
