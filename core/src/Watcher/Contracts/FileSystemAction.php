<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Contracts;

interface FileSystemAction
{
	public function fileModified(Event $event): void;

	public function fileMoved(Event $event): void;

	public function fileDeleted(Event $event): void;
}
