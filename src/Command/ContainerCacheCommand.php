<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

class ContainerCacheCommand extends Command
{
	public static function getName(): string
	{
		return 'container:cache';
	}

	public static function getDescription(): string
	{
		return 'Creates container cache for better performance';
	}

	public function run(Input $input, Output $output): int
	{
		if ($input->hasOption('clear')) {
			container()->flushCache();

			return Output::SUCCESS;
		}

		container()->dumpCache();

		return Output::SUCCESS;
	}
}
