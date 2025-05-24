<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Path;

use Sakoo\Framework\Core\Finder\Finder;
use Sakoo\Framework\Core\Finder\SplFileObject;

class Path
{
	public static function getRootDir(): false|string
	{
		return getcwd();
	}

	public static function getCoreDir(): false|string
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

	/**
	 * @return SplFileObject[]
	 */
	public static function getProjectPHPFiles(): array
	{
		if ($dir = Path::getRootDir()) {
			return static::getPHPFilesOf($dir);
		}

		return [];
	}

	/**
	 * @return SplFileObject[]
	 */
	public static function getCorePHPFiles(): array
	{
		if ($dir = Path::getCoreDir()) {
			return static::getPHPFilesOf($dir);
		}

		return [];
	}

	/**
	 * @return SplFileObject[]
	 */
	public static function getPHPFilesOf(string $path): array
	{
		return Finder::create($path)
			->pattern('*.php')
			->ignoreVCS()
			->ignoreVCSIgnored()
			->ignoreDotFiles()
			->getFiles();
	}
}
