<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Watcher;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Tests\TestCase;
use Sakoo\Framework\Core\Watcher\EventTypes;
use Sakoo\Framework\Core\Watcher\Inotify\Event;
use Sakoo\Framework\Core\Watcher\Inotify\File;

final class EventTest extends TestCase
{
	#[DataProvider('types')]
	#[Test]
	public function event_object_encapsulates_inputs(int $mask, EventTypes $eventType): void
	{
		$file = $this->createMock(File::class);
		$event = new Event($file, [
			'mask' => $mask,
			'wd' => 300,
			'cookie' => 500,
		]);

		$this->assertSame($file->getPath(), $event->getName());
		$this->assertSame($file, $event->getFile());
		$this->assertSame($eventType, $event->getType());
		$this->assertSame(300, $event->getHandlerId());
		$this->assertSame(500, $event->getGroupId());
	}

	public static function types(): \Generator
	{
		yield [IN_MODIFY, EventTypes::MODIFY];
		yield [IN_MOVE_SELF, EventTypes::MOVE];
		yield [IN_DELETE_SELF, EventTypes::DELETE];
	}
}
