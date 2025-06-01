<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\ServiceLoader;

use Psr\Clock\ClockInterface;
use Psr\Log\LoggerInterface;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Container\ContainerInterface;
use Sakoo\Framework\Core\Logger\FileLogger;
use Sakoo\Framework\Core\Markup\Markdown;
use Sakoo\Framework\Core\Markup\Markup;
use Sakoo\Framework\Core\Profiler\Profiler;
use Sakoo\Framework\Core\Profiler\ProfilerInterface;
use Sakoo\Framework\Core\Str\Str;
use Sakoo\Framework\Core\Str\Stringable;

class MainServiceLoader extends ServiceLoader
{
	public function load(Container $container): void
	{
		$container->singleton(LoggerInterface::class, FileLogger::class);

		$container->bind(Markup::class, Markdown::class);
		$container->bind(ClockInterface::class, Clock::class);
		$container->bind(Stringable::class, Str::class);
		$container->bind(ProfilerInterface::class, Profiler::class);
		$container->bind(ContainerInterface::class, Container::class);
	}
}
