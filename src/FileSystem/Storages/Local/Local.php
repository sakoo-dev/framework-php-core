<?php

namespace Sakoo\Framework\Core\FileSystem\Storages\Local;

use Sakoo\Framework\Core\FileSystem\Storage;
use Symfony\Component\Finder\Finder;
use Webmozart\Assert\Assert;

class Local implements Storage
{
	use CanBeDirectory;
	use CanBeWritable;

	public function __construct(private string $path)
	{
	}

	public function create(bool $asDirectory = false): bool
	{
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
		Assert::true(file_exists($this->path), 'File Does not Exist');
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
		Assert::true($this->isDir(), 'File must be a Directory');
		return iterator_to_array(Finder::create()->in($this->path)->files());
	}

	public function write(string $data): bool
	{
		Assert::false($this->isDir(), 'File could not be a Directory');
		return $this->writeToFile($data, 'w');
	}

	public function append(string $data): bool
	{
		Assert::false($this->isDir(), 'File could not be a Directory');
		return $this->writeToFile($data, 'a');
	}

	public function readLines(): array|false
	{
		Assert::true($this->exists(), 'File Does not Exist');
		Assert::false($this->isDir(), 'File could not be a Directory');
		return file($this->path);
	}
}
