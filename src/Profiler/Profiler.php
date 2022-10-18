<?php

namespace Sakoo\Framework\Core\Profiler;

use Sakoo\Framework\Core\DateTime\DateTime;

class Profiler
{
	private int $startTime;

	public function __construct()
	{
		$this->startTime = DateTime::getNowMilis();
	}

	public function elapsedTime(): int
	{
		return DateTime::getNowMilis() - $this->startTime;
	}
}
