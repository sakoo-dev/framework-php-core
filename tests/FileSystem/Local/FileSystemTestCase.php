<?php

namespace Sakoo\Framework\Core\Tests\FileSystem\Local;

use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

class FileSystemTestCase extends TestCase
{
	protected Storage $file;
	protected string $filePath;
	protected string $parentDirPath;

	protected function setUp(): void
	{
		$this->parentDirPath = Path::getStorageDir() . '/tests/file';
		$this->filePath = "$this->parentDirPath/test.txt";
		$this->file = File::open(Disk::Local, $this->filePath);

		$this->resetFileSystemTestEnv();
	}

	protected function tearDown(): void
	{
		$this->resetFileSystemTestEnv();
	}

	protected function manualCreateFile(bool $asDirectory): bool
	{
		if ($asDirectory) {
			return mkdir(directory: $this->filePath, recursive: true);
		}

		mkdir(directory: $this->parentDirPath, recursive: true);
		return touch($this->filePath);
	}

	private function resetFileSystemTestEnv(): void
	{
		File::open(Disk::Local, $this->parentDirPath)
			->remove();
	}
}
