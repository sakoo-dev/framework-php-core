<?php

namespace Sakoo\Framework\Core\DateTime;

use Sakoo\Framework\Core\DateTime\Exceptions\DateTimeTestModeException;

class DateTime
{
	private static bool $isTestNow = false;
	private static $testDatetime;

	public static function setTestNow($datetime = null): void
	{
		throwUnless(kernel()->isInTestMode(), new DateTimeTestModeException());

		if (is_string($datetime)) {
			$datetime = strtotime($datetime);
		}

		static::$isTestNow = !is_null($datetime);
		static::$testDatetime = $datetime;
	}

	public static function getNow($format = null): mixed
	{
		$now = static::$isTestNow ? static::$testDatetime : time();
		return is_null($format) ? $now : date($format, $now);
	}

	public static function getNowMilis(): int
	{
		return static::$isTestNow ? (static::$testDatetime * 1000) : ((int) microtime(true) * 1000);
	}
}
