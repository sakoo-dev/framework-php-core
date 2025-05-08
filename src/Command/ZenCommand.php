<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\AsCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Constants;

#[AsCommand('zen', 'Display Zen of the ' . Constants::FRAMEWORK_NAME)]
class ZenCommand extends Command
{
	public function run(Input $input, Output $output): int
	{
		$output->block([
			"\t\t=======================",
			"\t\t=========",
			' =======================',
		], style: 'fg=cyan');

		$output->text([
			Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')',
			'Copyright ' . date('Y') . ' by ' . Constants::AUTHOR,
		]);

		$output->newLine();

		return Command::SUCCESS;
	}
}
