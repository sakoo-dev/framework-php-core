<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Contracts;

use Sakoo\Framework\Core\Set\IterableInterface;

interface WatcherDriver
{
	public function watch(string $file, FileSystemAction $callback): void;

	public function wait(): IterableInterface;

	public function blind($id): bool;
}
