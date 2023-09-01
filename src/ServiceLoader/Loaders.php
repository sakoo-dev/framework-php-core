<?php

declare(strict_types=1);

use Sakoo\Framework\Core\ServiceLoader\MainServiceLoader;
use Sakoo\Framework\Core\ServiceLoader\WatcherServiceLoader;

return [
	MainServiceLoader::class,
	WatcherServiceLoader::class,
];
