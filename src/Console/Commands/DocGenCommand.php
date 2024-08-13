<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Doc\Doc;
use Sakoo\Framework\Core\Doc\Formatters\NamespaceBasedFormatter;
use Sakoo\Framework\Core\Path\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('doc:gen', 'Generates Document of Framework')]
class DocGenCommand extends Command
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		$style = new SymfonyStyle($input, $output);
		$style->block('Generating ...', style: 'fg=cyan');

		$excluded = [
			'Loaders.php',
			'helpers.php',
			'Bootstrap.php',
		];

		$finder = Path::getCorePHPFiles($excluded);
		$formatter = new NamespaceBasedFormatter();
		(new Doc($finder, $formatter))->generate();

		$style->block('Document has been Generated Successfully!', style: 'fg=green');

		return Command::SUCCESS;
	}
}
