<?php

namespace Sakoo\Framework\Core\Tests\Watcher;

use Sakoo\Framework\Core\Testing\TestCase;
use Sakoo\Framework\Core\Utilities\Locker;
use Sakoo\Framework\Core\Watcher\Inotify\Event;
use Sakoo\Framework\Core\Watcher\Inotify\Handler;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;
use Sakoo\Framework\Core\Watcher\WatcherActions;

class WatcherActionsTest extends TestCase
{
	public function test_it_calls_file_modified_action()
	{
		$actions = new WatcherActions();

		$inotify = $this->createMock(Inotify::class);
		$handler = $this->createMock(Handler::class);

		$event = new Event($handler, [
			'wd' => 1,
			'name' => 'file.txt',
			'mask' => IN_MODIFY,
			'cookie' => 0,
		]);

		$handler->method('getLocker')
			->willReturn(new Locker());

		$runCount = 0;
		$handler->method('getCallback')
			->willReturn(function (Event $mEvent, Handler $mHandler) use ($event, &$runCount) {
				++$runCount;
				$locker = $mHandler->getLocker();
				$this->assertTrue($locker->isLocked());
				$locker->unlock();
				$this->assertFalse($locker->isLocked());
				$this->assertSame($event, $mEvent);
				$locker->lock();
			});

		$actions->fileModified($event, $inotify);
		$actions->fileModified($event, $inotify);

		$this->assertEquals(1, $runCount);
	}

	public function test_it_calls_file_deleted_action()
	{
		$actions = new WatcherActions();

		$inotify = $this->createMock(Inotify::class);
		$handler = $this->createMock(Handler::class);

		$event = new Event($handler, [
			'wd' => 1,
			'name' => 'file.txt',
			'mask' => IN_DELETE_SELF,
			'cookie' => 0,
		]);

		$inotify->expects($this->once())
			->method('blind')
			->with($event->getHandlerId());

		$actions->fileDeleted($event, $inotify);
	}
}
