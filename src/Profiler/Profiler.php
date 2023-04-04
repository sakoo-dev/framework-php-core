<?php

namespace Sakoo\Framework\Core\Profiler;

use Sakoo\Framework\Core\Clock\Clock;

class Profiler
{
	private int $startTime;
	private Clock $clock;

	public function __construct()
	{
		$this->clock = new Clock();
		$this->startTime = $this->clock->now()->format('Uv');
	}

	public function elapsedTime(): int
	{
		return $this->clock->now()->format('Uv') - $this->startTime;
	}
}
