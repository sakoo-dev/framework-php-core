<?php

declare(strict_types=1);

namespace System\Path;

use Sakoo\Framework\Core\Path\Path as BasePath;

class Path extends BasePath
{
	public static function getAppDir(): false|string
	{
		return self::getRootDir() . '/app';
	}

	public static function getSystemDir(): false|string
	{
		return self::getRootDir() . '/system';
	}
}
