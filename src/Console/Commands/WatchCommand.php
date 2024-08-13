<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\WatcherActions\PhpBundler;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Watcher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('watch', 'Run file Watcher')]
class WatchCommand extends Command
{
	public function execute(InputInterface $input, OutputInterface $output): int
	{
		/** @var Watcher $watcher */
		$watcher = resolve(Watcher::class);
		$style = new SymfonyStyle($input, $output);

		$watcher = $watcher->watch(Path::getProjectPHPFiles(), new PhpBundler($style));
		$style->block('Watching ...', style: 'fg=cyan');
		$watcher->run();

		return Command::SUCCESS;
	}
}
