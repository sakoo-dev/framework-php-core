<?php

namespace Sakoo\Framework\Core\FileSystem;

use Sakoo\Framework\Core\FileSystem\Storages\Local\Local;

enum Disk: string
{
	case Local = Local::class;
}
