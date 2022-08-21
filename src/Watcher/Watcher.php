<?php

namespace Sakoo\Framework\Core\Watcher;

use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;
use Symfony\Component\Finder\Finder;

class Watcher
{
	public function __construct(
		private WatcherDriver $driver,
		private FileSystemAction $action,
	) {
	}

	public function watch(Finder $finder, callable $callback): self
	{
		$files = $finder->files();

		foreach ($files as $file) {
			$this->driver->watch($file->getRealPath(), $callback);
		}

		return $this;
	}

	public function run(): void
	{
		while (true) {
			$this->check();
		}
	}

	public function check(): void
	{
		$eventSet = $this->driver->wait();
		$eventSet->each(fn (Event $event) => $this->eventCall($event));
	}

	private function eventCall(Event $event): void
	{
		match ($event->getType()) {
			EventTypes::MODIFY => $this->action->fileModified($event, $this->driver),
			EventTypes::MOVE => $this->action->fileMoved($event, $this->driver),
			EventTypes::DELETE => $this->action->fileDeleted($event, $this->driver),
		};
	}
}
