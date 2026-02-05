<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Constants;

class VersionCommand extends Command
{
	public static function getName(): string
	{
		return 'version';
	}

	public static function getDescription(): string
	{
		return 'This command shows software version information';
	}

	public function run(Input $input, Output $output): int
	{
		$output->block(Constants::FRAMEWORK_NAME . ' - Version: ' . Constants::FRAMEWORK_VERSION, Output::COLOR_GREEN);

		return Output::SUCCESS;
	}
}
