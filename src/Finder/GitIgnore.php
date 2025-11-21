<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Finder;

use Sakoo\Framework\Core\Assert\Assert;

readonly class GitIgnore
{
	private array $rules;
	private string $root;

	public function __construct(private string $path = '.gitignore')
	{
		Assert::exists($this->path, 'gitignore not found: ' . $this->path);

		$this->root = dirname(realpath($this->path));
		$this->rules = $this->loadGitignore();
	}

	public function isIgnored(string $file): bool
	{
		$abs = realpath($file);

		if (false === $abs) {
			return false;
		}

		$rel = str_replace($this->root . '/', '', $abs);
		$rel = ltrim($rel, '/');

		$ignored = false;

		foreach ($this->rules as $rule) {
			if (preg_match($rule['regex'], $rel)) {
				$ignored = !$rule['negate'];
			}
		}

		return $ignored;
	}

	private function loadGitignore(): array
	{
		$lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$rules = [];

		foreach ($lines as $line) {
			$line = trim($line);

			if ('' === $line || '#' === $line[0]) {
				continue;
			}

			$isNegation = false;

			if ('!' === $line[0]) {
				$isNegation = true;
				$line = substr($line, 1);
			}

			$isRooted = str_starts_with($line, '/');

			if ($isRooted) {
				$line = substr($line, 1);
			}

			$regex = preg_quote($line, '/');
			$regex = str_replace('\*', '.*', $regex);
			$regex = str_replace('\?', '.', $regex);

			$isDir = str_ends_with($line, '/');

			if ($isDir) {
				$regex = rtrim($regex, '\/') . '(\/.*)?';
			}

			$regex = $isRooted
				? '/^' . $regex . '$/i'
				: '/(^|\/)' . $regex . '$/i';

			$rules[] = [
				'regex' => $regex,
				'negate' => $isNegation,
			];
		}

		return $rules;
	}
}
