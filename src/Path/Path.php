<?php

namespace Core\Path;

use Symfony\Component\Finder\Finder;

class Path
{
	public static function getRootDir(): string
	{
		return getcwd();
	}

	public static function getCoreDir(): string
	{
		return static::getRootDir() . '/src';
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
}
