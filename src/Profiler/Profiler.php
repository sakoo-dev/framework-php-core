<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Profiler;

use Psr\Clock\ClockInterface;

class Profiler implements ProfilerInterface
{
	private int $startTime;

	public function __construct(private ClockInterface $clock)
	{
		$this->startTime = (int) $this->clock->now()->format('Uv');
	}

	public function elapsedTime(): int
	{
		return (int) $this->clock->now()->format('Uv') - $this->startTime;
	}
}
