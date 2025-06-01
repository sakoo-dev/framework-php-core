<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Profiler;

use Psr\Clock\ClockInterface;

class Profiler implements ProfilerInterface
{
	/** @var int[] */
	protected array $instances = [];

	public function __construct(private readonly ClockInterface $clock) {}

	public function start(string $key): void
	{
		$this->instances[$key] = (int) $this->clock->now()->format('Uv');
	}

	public function elapsedTime(string $key): int
	{
		return (int) $this->clock->now()->format('Uv') - $this->instances[$key];
	}
}
