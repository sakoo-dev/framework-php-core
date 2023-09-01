<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Path;

use Symfony\Component\Finder\Finder;

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

	public static function getProjectPHPFiles(): Finder
	{
		return Finder::create()
			->name(['*.php'])
			->ignoreVCS(true)
			->ignoreVCSIgnored(true)
			->ignoreDotFiles(true)
			->in(static::getRootDir());
	}

	public static function getCorePHPFiles(array|string $exclude = ''): Finder
	{
		$finder = Finder::create()
			->name(['*.php'])
			->ignoreVCS(true)
			->ignoreVCSIgnored(true)
			->ignoreDotFiles(true)
			->in(Path::getCoreDir());

		if (!empty($exclude)) {
			$finder = $finder->notPath($exclude);
		}

		return $finder;
	}
}
