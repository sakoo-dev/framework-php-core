<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Watcher;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Locker\Locker;
use Sakoo\Framework\Core\Tests\TestCase;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Inotify\Event;
use Sakoo\Framework\Core\Watcher\Inotify\File;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;
use Sakoo\Framework\Core\Watcher\Watcher;

final class WatcherTest extends TestCase
{
	#[DataProvider('masks')]
	#[Test]
	public function watcher_works_properly(int $mask, string $callbackFn): void
	{
		$inotify = $this->createMock(Inotify::class);
		$fileSystemAction = $this->createMock(FileSystemAction::class);

		$file = new File(100, '/tmp/test', $fileSystemAction, new Locker());
		$event = new Event($file, ['mask' => $mask, 'wd' => 100, 'cookie' => 0]);

		$inotify->method('wait')->willReturn(set([$event]));

		$fileSystemAction
			->expects($this->once())
			->method($callbackFn)
			->with($this->isInstanceOf(Event::class));

		(new Watcher($inotify))->check();
	}

	public static function masks(): \Generator
	{
		yield [IN_MODIFY, 'fileModified'];
		yield [IN_MOVE_SELF, 'fileMoved'];
		yield [IN_DELETE_SELF, 'fileDeleted'];
	}
}
