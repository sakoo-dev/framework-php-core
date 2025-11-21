<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Finder;

use Sakoo\Framework\Core\Assert\Assert;

final class FileFinder
{
	private string $pattern = '*';
	private bool $ignoreVCS = false;
	private bool $ignoreVCSIgnored = false;
	private bool $ignoreDotFiles = false;

	public function __construct(private readonly string $path) {}

	public function pattern(string $pattern): FileFinder
	{
		$this->pattern = $pattern;

		return $this;
	}

	public function ignoreVCS(bool $value = true): FileFinder
	{
		$this->ignoreVCS = $value;

		return $this;
	}

	public function ignoreVCSIgnored(bool $value = true): FileFinder
	{
		$this->ignoreVCSIgnored = $value;

		return $this;
	}

	public function ignoreDotFiles(bool $value = true): FileFinder
	{
		$this->ignoreDotFiles = $value;

		return $this;
	}

	/**
	 * @return SplFileObject[]
	 */
	public function getFiles(): array
	{
		$result = [];

		foreach ($this->find() as $file) {
			$result[] = new SplFileObject($file, 'r+');
		}

		return $result;
	}

	private function find(): array
	{
		Assert::dir($this->path, "The path '{$this->path}' is not a valid directory.");

		$directory = new \RecursiveDirectoryIterator($this->path, \FilesystemIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS);
		$filter = new \RecursiveCallbackFilterIterator($directory, fn (\SplFileInfo $file) => $this->cutRecursiveIteratorTree($file));
		$iterator = new \RecursiveIteratorIterator($filter, \RecursiveIteratorIterator::SELF_FIRST);
		$gitIgnore = new GitIgnore();

		$files = [];

		foreach ($iterator as $file) {
			$fileName = $file->getFilename();

			if ($this->ignoreDotFiles && str_starts_with($fileName, '.')) {
				continue;
			}

			if ($this->ignoreVCSIgnored && $gitIgnore->isIgnored($file->getRealPath())) {
				continue;
			}

			if (!fnmatch($this->pattern, $fileName)) {
				continue;
			}

			if ($file->isFile()) {
				$files[] = $file->getPathname();
			}
		}

		return $files;
	}

	private function cutRecursiveIteratorTree(\SplFileInfo $file): bool
	{
		if ($file->isDir()) {
			$name = $file->getFilename();

			if ($this->ignoreVCS && in_array($name, ['.git', '.svn', '.hg', '.bzr'])) {
				return false;
			}

			return true;
		}

		return true;
	}
}
