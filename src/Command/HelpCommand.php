<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\AsCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

#[AsCommand('--help', 'Help')]
class HelpCommand extends Command
{
	public function run(Input $input, Output $output): int
	{
		$output->block('Helppppppp', style: 'fg=cyan');

		return Command::SUCCESS;
	}
}
