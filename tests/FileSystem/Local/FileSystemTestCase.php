<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\FileSystem\Local;

use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

abstract class FileSystemTestCase extends TestCase
{
	protected Storage $file;
	protected string $filePath;
	protected string $parentDirPath;

	protected function setUp(): void
	{
		$this->parentDirPath = Path::getTempTestDir() . '/filesystem';
		$this->filePath = "$this->parentDirPath/test";

		$this->file = File::open(Disk::Local, $this->filePath);

		$this->resetFileSystemTestEnv();
	}

	protected function tearDown(): void
	{
		$this->resetFileSystemTestEnv();
	}

	protected function createFile(): bool
	{
		mkdir(directory: $this->parentDirPath, recursive: true);

		return touch($this->filePath);
	}

	protected function createDirectory(): bool
	{
		return mkdir(directory: $this->filePath, recursive: true);
	}

	private function resetFileSystemTestEnv(): void
	{
		File::open(Disk::Local, $this->parentDirPath)->remove();
	}
}
