<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Locker\Locker;
use Sakoo\Framework\Core\Watcher\Contracts\File as FileInterface;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;

readonly class File implements FileInterface
{
	public function __construct(
		private int $id,
		private string $path,
		private FileSystemAction $callback,
		private Locker $locker,
	) {}

	public function getId(): int
	{
		return $this->id;
	}

	public function getCallback(): FileSystemAction
	{
		return $this->callback;
	}

	public function getPath(): string
	{
		return $this->path;
	}

	public function getLocker(): Locker
	{
		return $this->locker;
	}
}
