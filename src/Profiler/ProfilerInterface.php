<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Profiler;

interface ProfilerInterface
{
	public function elapsedTime(): int;
}
