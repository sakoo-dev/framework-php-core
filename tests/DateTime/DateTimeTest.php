<?php

namespace Sakoo\Framework\Core\Tests\DateTime;

use Sakoo\Framework\Core\DateTime\DateTime;
use Sakoo\Framework\Core\Tests\TestCase;

class DateTimeTest extends TestCase
{
	public function test_it_can_travel_in_time()
	{
		DateTime::setTestNow('2020-01-01 00:00:00');
		$this->assertEquals(1577824200, DateTime::getNow());
		$this->assertEquals(1577824200000, DateTime::getNowMilis());

		DateTime::setTestNow();
		$this->assertEquals(time(), DateTime::getNow());
		$this->assertEquals((int) microtime(true) * 1000, DateTime::getNowMilis());
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
		$this->assertSame(date($format), DateTime::getNow($format));
	}
}
