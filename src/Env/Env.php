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
		$lines = $file->exists() ? $file->readLines() : [];

		foreach ($lines as $line) {
			$line = trim($line);

			if (static::matchesPattern($line)) {
				static::storeValue(...static::getKeyValue($line));
			}
		}
	}

	private static function matchesPattern(string $line): bool
	{
		return (bool) preg_match('/^([a-zA-Z_]+[a-zA-Z0-9_]*)=(.*)$/', $line);
	}

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
