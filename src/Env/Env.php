<?php

namespace Sakoo\Framework\Core\Env;

use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;

class Env
{
	public static function get(string $key, mixed $default = null): mixed
	{
		return getenv($key) ?: $default;
	}

	public static function load(string $path): void
	{
		$lines = static::readDotEnv($path);

		foreach ($lines as $line) {
			$line = trim($line);
			if (static::matchesPattern($line)) {
				static::storeValue(...static::getKeyValue($line));
			}
		}
	}

	private static function readDotEnv(string $path): array
	{
		$file = File::open(Disk::Local, $path);
		return $file->exists() ? $file->readLines() : [];
	}

	private static function matchesPattern(string $line): bool
	{
		return preg_match('/^([a-zA-Z_]+[a-zA-Z0-9_]*)=(.*)$/', $line);
	}

	private static function getKeyValue(string $line): array
	{
		return explode('=', $line, 2);
	}

	private static function storeValue(string $key, string $value): void
	{
		putenv("$key=$value");
		$_ENV[$key] = $value;
		$_SERVER[$key] = $value;
	}
}
