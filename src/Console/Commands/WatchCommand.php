<?php

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\WatcherActions\PhpBundler;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Contracts\File;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;
use Sakoo\Framework\Core\Watcher\Inotify\File as InotifyFile;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;
use Sakoo\Framework\Core\Watcher\Watcher;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class WatchCommand extends Command
{
	protected static $defaultName = 'watch';
	protected static $defaultDescription = 'Run file Watcher';

	public function execute(InputInterface $input, OutputInterface $output): int
	{
		// Move to ServiceLoader in the future
		bind(WatcherDriver::class, Inotify::class);
		bind(File::class, InotifyFile::class);

		/** @var Watcher $watcher */
		$watcher = resolve(Watcher::class);
		$style = new SymfonyStyle($input, $output);

		$watcher = $watcher->watch(Path::getProjectPHPFiles(), new PhpBundler($style));
		$style->block('Watching ...', style: 'fg=cyan');
		$watcher->run();

		return Command::SUCCESS;
	}
}
