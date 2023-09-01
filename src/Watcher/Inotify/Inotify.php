<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Set\Iteratable;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;

class Inotify implements WatcherDriver
{
	private $inotify;
	private Iteratable $handlerSet;

	public function __construct()
	{
		$this->handlerSet = set();
		$this->inotify = inotify_init();
	}

	public function watch(string $file, FileSystemAction $callback): void
	{
		$masks = IN_MODIFY | IN_MOVE_SELF | IN_DELETE_SELF;
		$wd = inotify_add_watch($this->inotify, $file, $masks);
		$this->handlerSet->add((string) $wd, new File($wd, $file, $callback));
	}

	public function wait(): Iteratable
	{
		$eventSet = set();
		$events = inotify_read($this->inotify);

		foreach ($events as $event) {
			$handler = $this->handlerSet->get((string) $event['wd']);
			$eventSet->add(new Event($handler, $event));
		}

		return $eventSet;
	}

	public function blind($id): bool
	{
		return inotify_rm_watch($this->inotify, $id);
	}
}
