<?php

namespace Sakoo\Framework\Core\Tests\Watcher\Inotify;

use Sakoo\Framework\Core\Testing\TestCase;
use Sakoo\Framework\Core\Utilities\Locker;
use Sakoo\Framework\Core\Watcher\Inotify\Handler;

class HandlerTest extends TestCase
{
	public function test_handler_gets_correct_data()
	{
		$handler = new Handler(100, 'some/path', fn () => null);

		$this->assertEquals(100, $handler->getId());
		$this->assertEquals('some/path', $handler->getFile());
		$this->assertEquals(fn () => null, $handler->getCallback());
		$this->assertInstanceOf(Locker::class, $handler->getLocker());
	}
}
