<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\ServiceLoader;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\VarDump\Cli\CliDumper;
use Sakoo\Framework\Core\VarDump\Cli\CliFormatter;
use Sakoo\Framework\Core\VarDump\Dumper;
use Sakoo\Framework\Core\VarDump\Formatter;
use Sakoo\Framework\Core\VarDump\Http\HttpDumper;
use Sakoo\Framework\Core\VarDump\Http\HttpFormatter;

class VarDumpLoader extends ServiceLoader
{
	public function load(Container $container): void
	{
		if (kernel()->isInHttpMode()) {
			$container->singleton(Dumper::class, HttpDumper::class);
			$container->singleton(Formatter::class, HttpFormatter::class);

			return;
		}

		$container->singleton(Dumper::class, CliDumper::class);
		$container->singleton(Formatter::class, CliFormatter::class);
	}
}
