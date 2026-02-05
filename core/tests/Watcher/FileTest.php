<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Watcher;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Locker\Locker;
use Sakoo\Framework\Core\Tests\TestCase;
use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Inotify\File;

final class FileTest extends TestCase
{
	#[Test]
	public function file_object_encapsulates_inputs(): void
	{
		$id = 5000;
		$path = '/tmp/test';
		$locker = new Locker();
		$fileSystemAction = new class implements FileSystemAction {
			public function fileModified(Event $event): void {}

			public function fileMoved(Event $event): void {}

			public function fileDeleted(Event $event): void {}
		};

		$file = new File($id, $path, $fileSystemAction, $locker);

		$this->assertSame($id, $file->getId());
		$this->assertSame($path, $file->getPath());
		$this->assertSame($fileSystemAction, $file->getCallback());
		$this->assertSame($locker, $file->getLocker());
	}
}
