<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command\Watcher;

use Sakoo\Framework\Core\Console\AsCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Watcher;

#[AsCommand('watch', 'Run file Watcher')]
class WatchCommand extends Command
{
	public function run(Input $input, Output $output): int
	{
		/** @var Watcher $watcher */
		$watcher = resolve(Watcher::class);

		$watcher = $watcher->watch(Path::getProjectPHPFiles(), new PhpBundler());
		$style->block('Watching ...', style: 'fg=cyan');
		$watcher->run();

		return static::SUCCESS;
	}
}
