<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\AsCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

#[AsCommand('dev', 'Useful Information for Developer')]
class DevCommand extends Command
{
	public function run(Input $input, Output $output): int
	{
		$jit = opcache_get_status()['jit']['enabled'] ? 'Enabled' : 'Disabled';
		$output->block("JIT Enabled: $jit", style: 'fg=cyan');

		return static::SUCCESS;
	}
}
