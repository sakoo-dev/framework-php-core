<?php

namespace Sakoo\Framework\Core\Watcher;

use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;

class WatcherActions implements FileSystemAction
{
	public function fileModified(Event $event, WatcherDriver $driver)
	{
		$handler = $event->getHandler();
		$locker = $handler->getLocker();

		if ($locker->isLocked()) {
			return;
		}

		$locker->lock();
		$handler->getCallback()($event, $handler);
	}

	public function fileMoved(Event $event, WatcherDriver $driver)
	{
		$handler = $event->getHandler();
		$handler->getCallback()($event, $handler);
	}

	public function fileDeleted(Event $event, WatcherDriver $driver)
	{
		$driver->blind($event->getHandlerId());

		$handler = $event->getHandler();
		$handler->getCallback()($event, $handler);
	}
}
