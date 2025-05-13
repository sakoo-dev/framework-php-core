<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command\Watcher;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Watcher;

class WatchCommand extends Command
{
	public static function getName(): string
	{
		return 'watch';
	}

	public static function getDescription(): string
	{
		return 'Run the file Watcher';
	}

	public function run(Input $input, Output $output): int
	{
		/** @var Watcher $watcher */
		$watcher = resolve(Watcher::class);

		$watcher = $watcher->watch(Path::getProjectPHPFiles(), new PhpBundler($input, $output));
		$output->block('Watching ...', Output::COLOR_CYAN);
		$watcher->run();

		return Output::SUCCESS;
	}
}
