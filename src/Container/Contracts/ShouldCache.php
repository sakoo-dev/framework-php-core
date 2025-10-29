<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Contracts;

interface ShouldCache
{
	public function loadCache(): void;

	public function flushCache(): bool;

	public function cacheExists(): bool;

	public function dumpCache(): void;
}
