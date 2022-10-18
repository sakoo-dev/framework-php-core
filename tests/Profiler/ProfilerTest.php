<?php

namespace Sakoo\Framework\Core\Tests\Profiler;

use Sakoo\Framework\Core\DateTime\DateTime;
use Sakoo\Framework\Core\Profiler\Profiler;
use Sakoo\Framework\Core\Tests\TestCase;

class ProfilerTest extends TestCase
{
	public function test_it_can_measure_time()
	{
		DateTime::setTestNow('2020-01-01 00:00:00');
		$profiler = new Profiler();

		DateTime::setTestNow('2020-01-01 00:00:10');
		$this->assertEquals(10 * 1000, $profiler->elapsedTime());
	}
}
