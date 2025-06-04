<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Contracts;

interface FileSystemAction
{
	public function fileModified(Event $event);

	public function fileMoved(Event $event);

	public function fileDeleted(Event $event);
}
