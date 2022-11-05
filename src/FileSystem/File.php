<?php

namespace Sakoo\Framework\Core\FileSystem;

class File
{
	public static function open(Disk $storage, string $path): Storage
	{
		return new $storage->value($path);
	}
}
