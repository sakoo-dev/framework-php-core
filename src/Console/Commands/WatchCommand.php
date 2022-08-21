<?php

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\WatcherActions\PhpBundle;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Contracts\FileSystemAction;
use Sakoo\Framework\Core\Watcher\Contracts\Handler;
use Sakoo\Framework\Core\Watcher\Contracts\WatcherDriver;
use Sakoo\Framework\Core\Watcher\Inotify\Handler as InotifyHandler;
use Sakoo\Framework\Core\Watcher\Inotify\Inotify;
use Sakoo\Framework\Core\Watcher\Watcher;
use Sakoo\Framework\Core\Watcher\WatcherActions;
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
		bind(FileSystemAction::class, WatcherActions::class);
		bind(Handler::class, InotifyHandler::class);

		/** @var Watcher $watcher */
		$watcher = resolve(Watcher::class);
		$style = new SymfonyStyle($input, $output);

		$watcher = $watcher->watch(Path::getProjectPHPFiles(), new PhpBundle($style));
		$style->block('Watching ...', style: 'fg=cyan');
		$watcher->run();

		return Command::SUCCESS;
	}
}
