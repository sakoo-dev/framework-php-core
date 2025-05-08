<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Path;

use Sakoo\Framework\Core\Finder\Finder;

class Path
{
	public static function getRootDir(): string
	{
		return getcwd();
	}

	public static function getCoreDir(): string
	{
		return realpath(__DIR__ . '/../');
	}

	public static function getVendorDir(): string
	{
		return static::getRootDir() . '/vendor';
	}

	public static function getStorageDir(): string
	{
		return static::getRootDir() . '/storage';
	}

	public static function getLogsDir(): string
	{
		return static::getStorageDir() . '/logs';
	}

	public static function getTempTestDir(): string
	{
		return '/tmp/sakoo-test';
	}

	public static function getProjectPHPFiles(): array
	{
		return Finder::create(Path::getRootDir())
			->pattern('*.php')
			->ignoreVCS()
			->ignoreVCSIgnored()
			->ignoreDotFiles()
			->getFiles();
	}

	public static function getCorePHPFiles(): array
	{
		return Finder::create(Path::getCoreDir())
			->pattern('*.php')
			->ignoreVCS()
			->ignoreVCSIgnored()
			->ignoreDotFiles()
			->getFiles();
	}
}
