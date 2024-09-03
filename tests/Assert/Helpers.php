<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Assert;

use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Path\Path;

trait Helpers
{
	private function makeTemporaryFile(): Storage
	{
		$file = File::open(Disk::Local, Path::getTempTestDir() . '/assert/test.txt');
		$file->create();

		return $file;
	}

	public function makeTemporarySymlink(): string
	{
		$dir = File::open(Disk::Local, Path::getTempTestDir() . '/assert/');
		$dir->create(true);

		$file = $dir->getPath() . '/symlink';
		symlink(__FILE__, $file);

		return $file;
	}
}
