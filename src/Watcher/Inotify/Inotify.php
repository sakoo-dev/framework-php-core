<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Inotify;

use Sakoo\Framework\Core\Locker\Locker;
use Sakoo\Framework\Core\Set\IterableInterface;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;

class Inotify implements WatcherDriver
{
	/** @var resource */
	private $inotify;
	/**
	 * @var IterableInterface<File|string>
	 */
	private IterableInterface $handlerSet;

	public function __construct()
	{
		$this->handlerSet = set();
		$this->inotify = inotify_init();
	}

	public function watch(string $file, FileSystemAction $callback): void
	{
		$masks = IN_MODIFY | IN_MOVE_SELF | IN_DELETE_SELF;
		$wd = inotify_add_watch($this->inotify, $file, $masks);
		/** @var Locker $locker */
		$locker = makeInstance(Locker::class);
		// @phpstan-ignore argument.type
		$this->handlerSet->add((string) $wd, new File($wd, $file, $callback, $locker));
	}

	public function wait(): IterableInterface
	{
		$eventSet = set();
		$events = inotify_read($this->inotify);

		if (!$events) {
			return $eventSet;
		}

		foreach ($events as $event) {
			/** @var File $handler */
			$handler = $this->handlerSet->get((string) $event['wd']);
			// @phpstan-ignore argument.type
			$eventSet->add(new Event($handler, $event));
		}

		return $eventSet;
	}

	public function blind(int $id): bool
	{
		return inotify_rm_watch($this->inotify, $id);
	}
}
