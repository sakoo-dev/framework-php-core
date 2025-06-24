<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Finder;

use Sakoo\Framework\Core\Assert\Assert;

class Finder
{
	private string $pattern = '*';
	private array $excluded = [];
	private bool $ignoreVCS = false;
	private bool $ignoreVCSIgnored = false;
	private bool $ignoreDotFiles = false;

	public function __construct(private readonly string $path) {}

	public static function create(string $path): static
	{
		return new static($path);
	}

	/**
	 * @return SplFileObject[]
	 */
	public function getFiles(): array
	{
		Assert::dir($this->path, 'File must be a Directory');

		$files = $this->rglob(
			$this->path,
			$this->pattern,
			ignoreDotFiles: true,
			excludedPatterns: ['*/vendor/*'],
		);

		foreach ($files as $file) {
			$result[] = new SplFileObject($file, 'r+');
		}

		return $result;
	}

	public function pattern(string $pattern): static
	{
		$this->pattern = $pattern;

		return $this;
	}

	public function ignoreVCS(bool $ignore = true): static
	{
		$this->ignoreVCS = $ignore;

		return $this;
	}

	public function ignoreVCSIgnored(bool $ignore = true): static
	{
		$this->ignoreVCSIgnored = $ignore;

		return $this;
	}

	public function ignoreDotFiles(bool $ignore = true): static
	{
		$this->ignoreDotFiles = $ignore;

		return $this;
	}

	public function exclude(array $excluded): static
	{
		$this->excluded = $excluded;

		return $this;
	}

	private function rglob(
		string $path,
		string $pattern,
		bool $ignoreDotFiles = false,
		array $excludedPatterns = [],
		bool $ignoreVCS = false,
		bool $ignoreVCSIgnored = false
	): array {
		static $vcsIgnoredPatterns = null;

		if ($ignoreVCSIgnored && null === $vcsIgnoredPatterns) {
			$vcsIgnoredPatterns = $this->getGitIgnoredPatterns(getcwd());
		}

		$files = glob("$path/$pattern") ?: [];

		if (!$ignoreDotFiles) {
			$dotFiles = glob("$path/.$pattern") ?: [];

			if ($dotFiles) {
				$files = array_merge($files, $dotFiles);
			}
		}

		foreach (glob("$path/*", GLOB_ONLYDIR | GLOB_NOSORT) ?: [] as $dir) {
			$dirName = basename($dir);

			// Ignore VCS directories
			if ($ignoreVCS && in_array($dirName, ['.git', '.svn', '.hg', '.bzr'], true)) {
				continue;
			}

			// Skip excluded directories based on patterns
			if ($this->matchesPattern($dir, $excludedPatterns)) {
				continue;
			}

			$files = array_merge($files, $this->rglob($dir, $pattern, $ignoreDotFiles, $excludedPatterns, $ignoreVCS, $ignoreVCSIgnored));
		}

		// Remove excluded files based on patterns
		$files = array_filter($files, fn ($file) => !$this->matchesPattern($file, $excludedPatterns));

		// Remove dotfiles if needed
		if ($ignoreDotFiles) {
			$files = array_filter($files, fn ($file) => '.' !== basename($file)[0]);
		}

		// Remove VCS ignored files
		if ($ignoreVCSIgnored) {
			$files = array_filter($files, fn ($file) => !$this->isVCSIgnored($file, $vcsIgnoredPatterns));
		}

		return array_values($files);
	}

	private function matchesPattern(string $file, array $patterns): bool
	{
		foreach ($patterns as $pattern) {
			if (fnmatch($pattern, $file)) {
				return true;
			}
		}

		return false;
	}

	private function getGitIgnoredPatterns(string $rootPath): array
	{
		$gitignoreFile = "$rootPath/.gitignore";

		if (!file_exists($gitignoreFile)) {
			return [];
		}

		$patterns = array_filter(array_map('trim', file($gitignoreFile)), fn ($line) => '' !== $line && '#' !== $line[0]);

		return array_map(fn ($pattern) => preg_replace('/\*/', '.*', preg_quote($pattern, '/')), $patterns);
	}

	private function isVCSIgnored(string $file, array $vcsIgnoredPatterns): bool
	{
		foreach ($vcsIgnoredPatterns as $pattern) {
			if (preg_match("/^$pattern$/", $file)) {
				return true;
			}
		}

		return false;
	}
}
