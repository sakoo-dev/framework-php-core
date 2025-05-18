<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Env;

use Sakoo\Framework\Core\FileSystem\Storage;

class Env
{
	public static function get(string $key, mixed $default = null): mixed
	{
		return getenv($key) ?: $default;
	}

	public static function load(Storage $file): void
	{
		/** @var array<string> $lines */
		$lines = $file->exists() ? $file->readLines() : [];

		foreach ($lines as $line) {
			$line = trim($line);

			if (self::matchesPattern($line)) {
				self::storeValue(...self::getKeyValue($line));
			}
		}
	}

	private static function matchesPattern(string $line): bool
	{
		return (bool) preg_match('/^([a-zA-Z_]+[a-zA-Z0-9_]*)=(.*)$/', $line);
	}

	/**
	 * @return list<string>
	 */
	private static function getKeyValue(string $line): array
	{
		return explode('=', $line, 2);
	}

	private static function storeValue(string $key, string $value): void
	{
		putenv("$key=$value");
		$_ENV[$key] = $value;
	}
}
