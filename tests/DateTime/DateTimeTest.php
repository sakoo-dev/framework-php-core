<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\DateTime;

use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Tests\TestCase;

final class DateTimeTest extends TestCase
{
	public function test_it_can_travel_in_time()
	{
		$date = '2020-01-01 00:00:00';
		$clock = new Clock();

		Clock::setTestNow($date);
		$this->assertEquals(strtotime($date), $clock->now()->getTimestamp());

		Clock::setTestNow();
		$this->assertEquals(time(), $clock->now()->getTimestamp());
	}

	public function getFormats()
	{
		yield ['Y'];
		yield ['m'];
		yield ['d'];
		yield ['H'];
		yield ['i'];
		yield ['s'];
	}

	/** @dataProvider getFormats */
	public function test_get_now_function_accepts_standard_formats($format)
	{
		$clock = new Clock();
		$this->assertSame(date($format), $clock->now()->format($format));
	}
}
