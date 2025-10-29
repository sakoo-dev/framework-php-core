<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\FileSystem\Storages\Local;

use Sakoo\Framework\Core\Assert\Assert;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Finder\Finder;
use Sakoo\Framework\Core\Finder\SplFileObject;

class Local implements Storage
{
	/**
	 * - [ ]  Prevent working with files in unit tests / main code in filesystem scope (source code environment) | Remove storage/tests dependent tests
	 * - [ ]  FileSystem: 100% Coverage, TestTemp ⇒ instead of `sakoo-test` `Unique Id` of Project => in `.env` => on `make init`.
	 */
	use CanBeDirectory;
	use CanBeWritable;

	public function __construct(private string $path) {}

	public function create(bool $asDirectory = false): bool
	{
		if (file_exists($this->path)) {
			return false;
		}

		$this->mkdir();

		if ($asDirectory) {
			return mkdir($this->path);
		}

		return touch($this->path);
	}

	public function mkdir(bool $recursive = true): bool
	{
		if (file_exists($this->parentDir())) {
			return true;
		}

		return mkdir(directory: $this->parentDir(), recursive: $recursive);
	}

	public function exists(): bool
	{
		return file_exists($this->path);
	}

	public function remove(): bool
	{
		return $this->removeRecursive($this->path);
	}

	public function isDir(): bool
	{
		return is_dir($this->path);
	}

	public function move(string $to): bool
	{
		mkdir(directory: dirname($to), recursive: true);

		return $this->rename($to);
	}

	public function copy(string $to): bool
	{
		Assert::exists($this->path, 'File Does not Exist');

		return $this->copyRecursive($this->path, $to);
	}

	public function parentDir(): string
	{
		return dirname($this->path);
	}

	public function rename(string $to): bool
	{
		return rename($this->path, $to);
	}

	public function files(): array
	{
		Assert::dir($this->path, 'File must be a Directory');

		$files = Finder::create($this->path)->getFiles();
		$files = set($files)->map(fn (SplFileObject $file) => $file->getRealPath());

		return $files->toArray();
	}

	public function write(string $data): bool
	{
		Assert::notDir($this->path, 'File could not be a Directory');

		return $this->writeToFile($data, 'w');
	}

	public function append(string $data): bool
	{
		Assert::notDir($this->path, 'File could not be a Directory');

		return $this->writeToFile($data, 'a');
	}

	public function readLines(): array|false
	{
		Assert::exists($this->path, 'File Does not Exist');
		Assert::notDir($this->path, 'File could not be a Directory');

		return file($this->path);
	}

	public function setPermission(int|string $permission): bool
	{
		if (is_string($permission)) {
			$permission = (int) base_convert($permission, 8, 10);
		}

		return chmod($this->path, $permission);
	}

	public function getPermission(): mixed
	{
		return substr(sprintf('%o', fileperms($this->path)), -4);
	}

	public function getPath(): string
	{
		return $this->path;
	}
}
