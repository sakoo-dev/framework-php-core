<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\AsCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

#[AsCommand('X', 'Generates Document of Framework')]
class NoCommand extends Command
{
	public function run(Input $input, Output $output): int
	{
		$output->block('Your requested command not found. try --help', style: 'fg=cyan');

		return static::ERROR;
	}
}
