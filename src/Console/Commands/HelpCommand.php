<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

class HelpCommand extends Command
{
	public static function getName(): string
	{
		return 'help';
	}

	public static function getDescription(): string
	{
		return 'this command helps the user to interact with the current application';
	}

	public function run(Input $input, Output $output): int
	{
		$output->block('Assistant Help', Output::COLOR_CYAN);

		$commands = $this->getApplication()->getCommands();

		$output->block('Available commands:');

		/** @var Command $command */
		foreach ($commands as $command) {
			// @phpstan-ignore binaryOp.invalid
			$output->text("\t - " . $command->getName() . ': ', Output::COLOR_GREEN, style: Output::STYLE_BOLD);
			$output->block($command->getDescription(), Output::COLOR_WHITE);
		}

		return Output::SUCCESS;
	}
}
