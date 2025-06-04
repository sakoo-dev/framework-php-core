<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher;

use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;

readonly class Watcher
{
	public function __construct(private WatcherDriver $driver) {}

	public function watch(array $files, FileSystemAction $callback): self
	{
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
		$callback = $event->getFile()->getCallback();

		match ($event->getType()) {
			EventTypes::MODIFY => $callback->fileModified($event),
			EventTypes::MOVE => $callback->fileMoved($event),
			EventTypes::DELETE => $this->driver->blind($event->getHandlerId()) && $callback->fileDeleted($event),
		};
	}
}
