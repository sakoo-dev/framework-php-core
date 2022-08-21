<?php

namespace Sakoo\Framework\Core\Watcher\Contracts;

use Sakoo\Framework\Core\Set\Iteratable;

interface WatcherDriver
{
	public function watch(string $file, callable $callback): void;

	public function wait(): Iteratable;

	public function blind($id): bool;
}
