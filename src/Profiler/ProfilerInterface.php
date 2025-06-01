<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Profiler;

interface ProfilerInterface
{
	public function start(string $key): void;

	public function elapsedTime(string $key): int;
}
