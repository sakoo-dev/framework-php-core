<?php

namespace Sakoo\Framework\Core\Tests\Watcher;

use Sakoo\Framework\Core\Testing\TestCase;
use Sakoo\Framework\Core\Watcher\Inotify\Event;
use Sakoo\Framework\Core\Watcher\Inotify\Handler;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;
use Sakoo\Framework\Core\Watcher\Watcher;
use Sakoo\Framework\Core\Watcher\WatcherActions;
use Symfony\Component\Finder\Finder;

class WatcherTest extends TestCase
{
	public function eventTypes()
	{
		yield 'file modify' => [IN_MODIFY, 'fileModified'];
		yield 'file move' => [IN_MOVE_SELF, 'fileMoved'];
		yield 'file delete' => [IN_DELETE_SELF, 'fileDeleted'];
	}

	/** @dataProvider eventTypes  */
	public function test_watcher_can_trigger_suitable_callback($mask, $function)
	{
		$inotify = $this->createMock(Inotify::class);
		$action = $this->createMock(WatcherActions::class);
		$handler = $this->createMock(Handler::class);
		$finder = $this->createMock(Finder::class);

		$event = new Event($handler, [
			'wd' => 1,
			'name' => 'file.txt',
			'mask' => $mask,
			'cookie' => 0,
		]);

		$inotify->method('wait')
			->willReturn(set([$event]));

		$finder->method('files')
			->willReturn($finder);

		$action->expects($this->once())
			->method($function)
			->with($event, $inotify);

		(new Watcher($inotify, $action))
			->watch($finder, fn () => null)
			->check();
	}
}
