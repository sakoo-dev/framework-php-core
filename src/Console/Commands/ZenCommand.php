<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Constants;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('zen', 'Display Zen of the ' . Constants::FRAMEWORK_NAME)]
class ZenCommand extends Command
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$style = new SymfonyStyle($input, $output);

		$style->block([
			"\t\t=======================",
			"\t\t=========",
			' =======================',
		], style: 'fg=cyan');

		$style->text([
			Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')',
			'Copyright ' . date('Y') . ' by ' . Constants::AUTHOR,
		]);

		$style->newLine();

		return Command::SUCCESS;
	}
}
