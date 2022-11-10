<?php

namespace Sakoo\Framework\Core\ServiceLoader;

use Psr\Log\LoggerInterface;
use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Logger\FileLogger;

class AppServiceLoader extends ServiceLoader
{
	public function load(Container $container): void
	{
		$container->singleton(LoggerInterface::class, FileLogger::class);
	}
}
