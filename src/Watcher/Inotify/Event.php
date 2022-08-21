<?php

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Watcher\Contracts\Event as EventInterface;
use Sakoo\Framework\Core\Watcher\Contracts\Handler;
use Sakoo\Framework\Core\Watcher\EventTypes;

class Event implements EventInterface
{
	private int $wd;
	private $mask;
	private $cookie;
	private string $name;

	public function __construct(private Handler $handler, array $event)
	{
		$this->wd = $event['wd'];
		$this->mask = $event['mask'];
		$this->cookie = $event['cookie'];
		$this->name = $handler->getFile();
	}

	public function getHandler(): Handler
	{
		return $this->handler;
	}

	public function getHandlerId(): int
	{
		return $this->wd;
	}

	public function getType(): EventTypes
	{
		return match ($this->mask) {
			IN_MODIFY => EventTypes::MODIFY,
			IN_MOVE_SELF => EventTypes::MOVE,
			IN_DELETE_SELF => EventTypes::DELETE,
		};
	}

	public function getGroupId()
	{
		return $this->cookie;
	}

	public function getName(): string
	{
		return $this->name;
	}
}
