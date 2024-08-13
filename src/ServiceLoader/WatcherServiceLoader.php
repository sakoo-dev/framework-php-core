<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\ServiceLoader;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Watcher\Contracts\File;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;
use Sakoo\Framework\Core\Watcher\Inotify\File as InotifyFile;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;

class WatcherServiceLoader extends ServiceLoader
{
	public function load(Container $container): void
	{
		$container->bind(WatcherDriver::class, Inotify::class);
		$container->bind(File::class, InotifyFile::class);
	}
}
