<?php

namespace Sakoo\Framework\Core\Watcher\Contracts;

interface FileSystemAction
{
	public function fileModified(Event $event, WatcherDriver $driver);

	public function fileMoved(Event $event, WatcherDriver $driver);

	public function fileDeleted(Event $event, WatcherDriver $driver);
}
