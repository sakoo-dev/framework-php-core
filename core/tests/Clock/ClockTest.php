<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Clock;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Tests\TestCase;

final class ClockTest extends TestCase
{
	#[Test]
	public function now_function_works_on_psr_standards(): void
	{
		$clock = new Clock();
		$this->assertInstanceOf(\DateTimeImmutable::class, $clock->now());
		$this->assertEquals(time(), $clock->now()->getTimestamp());
	}

	#[Test]
	public function set_test_now_function_can_travel_in_time(): void
	{
		$clock = new Clock();

		Clock::setTestNow('2020-01-01 00:00:00');
		$this->assertEquals(strtotime('2020-01-01 00:00:00'), $clock->now()->getTimestamp());

		Clock::setTestNow();
		$this->assertEquals(time(), $clock->now()->getTimestamp());
	}
}
