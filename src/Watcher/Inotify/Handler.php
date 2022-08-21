<?php

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Utilities\Locker;
use Sakoo\Framework\Core\Watcher\Contracts\Handler as HandlerInterface;

class Handler implements HandlerInterface
{
	private Locker $locker;

	public function __construct(
		private int $id,
		private string $file,
		private $callback,
	) {
		$this->locker = makeInstance(Locker::class);
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getCallback(): callable
	{
		return $this->callback;
	}

	public function getFile(): string
	{
		return $this->file;
	}

	public function getLocker(): Locker
	{
		return $this->locker;
	}
}
