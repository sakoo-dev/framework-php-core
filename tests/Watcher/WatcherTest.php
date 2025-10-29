<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Watcher;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Finder\SplFileObject;
use Sakoo\Framework\Core\Tests\TestCase;
use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;
use Sakoo\Framework\Core\Watcher\Watcher;

final class WatcherTest extends TestCase
{
	#[Test]
	public function watcher_works_properly(): void
	{
		$inotify = new Inotify();
		$watcher = new Watcher($inotify);
		$watcher->watch([new SplFileObject('file')], new class implements FileSystemAction {
			public function fileModified(Event $event): void {}

			public function fileMoved(Event $event): void {}

			public function fileDeleted(Event $event): void {}
		});

		$watcher->run();
		$watcher->check();
	}
}
