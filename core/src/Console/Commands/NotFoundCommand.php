<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

class NotFoundCommand extends Command
{
	public static function getName(): string
	{
		return 'not-found';
	}

	public static function getDescription(): string
	{
		return 'This command will be called when a user requested command is not found';
	}

	public function run(Input $input, Output $output): int
	{
		$output->block('Requested command has not found.', Output::COLOR_RED);
		$output->block('try "./sakoo assist help" to get more information', Output::COLOR_GREEN);

		return Output::ERROR;
	}
}
