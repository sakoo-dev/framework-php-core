<?php

namespace Sakoo\Framework\Core\Clock;

use Psr\Clock\ClockInterface;
use Sakoo\Framework\Core\Clock\Exceptions\ClockTestModeException;

class Clock implements ClockInterface
{
	private static ?\DateTimeImmutable $testNow = null;

	public static function setTestNow(\DateTimeInterface|string|null $datetime = null): void
	{
		throwUnless(kernel()->isInTestMode(), new ClockTestModeException());

		if (is_null($datetime)) {
			static::$testNow = null;
			return;
		}

		static::$testNow = \DateTimeImmutable::createFromMutable(
			is_string($datetime) ? new \DateTime($datetime) : $datetime
		);
	}

	public function now(): \DateTimeImmutable
	{
		return empty(static::$testNow) ? new \DateTimeImmutable() : static::$testNow;
	}
}
