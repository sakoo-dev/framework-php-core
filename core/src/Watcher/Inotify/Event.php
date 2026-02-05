<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Watcher\Contracts\Event as EventInterface;
use Sakoo\Framework\Core\Watcher\Contracts\File;
use Sakoo\Framework\Core\Watcher\EventTypes;

class Event implements EventInterface
{
	private int $wd;
	private int $mask;
	private int $cookie;
	private string $name;

	/** @param int[] $event */
	public function __construct(private readonly File $file, array $event)
	{
		$this->wd = $event['wd'];
		$this->mask = $event['mask'];
		$this->cookie = $event['cookie'];
		$this->name = $file->getPath();
	}

	public function getFile(): File
	{
		return $this->file;
	}

	public function getHandlerId(): int
	{
		return $this->wd;
	}

	public function getType(): EventTypes
	{
		if ($this->mask & IN_MODIFY) {
			return EventTypes::MODIFY;
		}

		if ($this->mask & IN_MOVE_SELF) {
			return EventTypes::MOVE;
		}

		if ($this->mask & IN_DELETE_SELF) {
			return EventTypes::DELETE;
		}

		return EventTypes::MODIFY;
	}

	public function getGroupId(): int
	{
		return $this->cookie;
	}

	public function getName(): string
	{
		return $this->name;
	}
}
