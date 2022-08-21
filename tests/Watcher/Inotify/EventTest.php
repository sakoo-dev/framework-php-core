<?php

namespace Sakoo\Framework\Core\Tests\Watcher\Inotify;

use Sakoo\Framework\Core\Testing\TestCase;
use Sakoo\Framework\Core\Watcher\EventTypes;
use Sakoo\Framework\Core\Watcher\Inotify\Event;
use Sakoo\Framework\Core\Watcher\Inotify\Handler;

class EventTest extends TestCase
{
	public function test_event_gets_correct_data()
	{
		$handler = $this->createMock(Handler::class);

		$handler->method('getFile')
			->willReturn('some-path');

		$inotifyEvent = [
			'wd' => 1,
			'name' => 'file.txt',
			'mask' => IN_MODIFY,
			'cookie' => 0,
		];

		$event = new Event($handler, $inotifyEvent);

		$this->assertEquals($handler, $event->getHandler());
		$this->assertEquals($inotifyEvent['wd'], $event->getHandlerId());
		$this->assertEquals(EventTypes::MODIFY, $event->getType());
		$this->assertEquals($inotifyEvent['cookie'], $event->getGroupId());
		$this->assertEquals('some-path', $event->getName());
	}
}
