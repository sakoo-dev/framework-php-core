<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Profiler;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Profiler\Profiler;
use Sakoo\Framework\Core\Tests\TestCase;

final class ProfilerTest extends TestCase
{
	#[Test]
	public function it_can_measure_time(): void
	{
		$mock = $this->createMock(Clock::class);

		$mock->expects($this->exactly(2))
			->method('now')
			->willReturnOnConsecutiveCalls(
				new \DateTimeImmutable('2020-01-01 00:00:00'),
				new \DateTimeImmutable('2020-01-01 00:00:10'),
			);

		$profiler = new Profiler($mock);
		Clock::setTestNow('2020-01-01 00:00:00');
		$profiler->start('TEST');

		Clock::setTestNow('2020-01-01 00:00:10');
		$this->assertEquals(10 * 1000, $profiler->elapsedTime('TEST'));
	}
}
