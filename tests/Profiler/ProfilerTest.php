<?php

namespace Sakoo\Framework\Core\Tests\Profiler;

use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Profiler\Profiler;
use Sakoo\Framework\Core\Tests\TestCase;

class ProfilerTest extends TestCase
{
	public function test_it_can_measure_time()
	{
		Clock::setTestNow('2020-01-01 00:00:00');
		$profiler = new Profiler();

		Clock::setTestNow('2020-01-01 00:00:10');
		$this->assertEquals(10 * 1000, $profiler->elapsedTime());
	}
}
