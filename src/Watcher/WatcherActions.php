<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher;

use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;

abstract class WatcherActions implements FileSystemAction
{
	public function fileModified(Event $event)
	{
		$locker = $event->getFile()->getLocker();

		if ($locker->isLocked()) {
			return;
		}

		$locker->lock();
	}

	public function fileMoved(Event $event) {}

	public function fileDeleted(Event $event) {}
}
