<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Utilities\Locker;
use Sakoo\Framework\Core\Watcher\Contracts\File as FileInterface;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;

class File implements FileInterface
{
	private Locker $locker;

	public function __construct(
		private int $id,
		private string $path,
		private FileSystemAction $callback,
	) {
		$this->locker = makeInstance(Locker::class);
	}

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
