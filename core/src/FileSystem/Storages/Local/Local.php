<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\FileSystem\Storages\Local;

use Sakoo\Framework\Core\Assert\Assert;
use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Finder\FileFinder;

class Local implements Storage
{
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

	/**
	 * @throws InvalidArgumentException
	 */
	public function files(): array
	{
		Assert::dir($this->path, 'File must be a Directory');

		$files = (new FileFinder($this->path))->getFiles();

		$result = [];

		foreach ($files as $file) {
			$result[] = $file->getRealPath();
		}

		return $result;
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

	/**
	 * @return false|string[]
	 */
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
