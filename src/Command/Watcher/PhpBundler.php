<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command\Watcher;

use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\WatcherActions;

class PhpBundler extends WatcherActions
{
	public function __construct(private Input $input, private Output $output) {}

	public function fileModified(Event $event): void
	{
		parent::fileModified($event);

		$path = $event->getFile()->getPath();
		$this->output->block("$path changed at " . date('H:i:s'), style: 'fg=green');

		$this->makeLint($path);

		$event->getFile()->getLocker()->unlock();
		$this->output->block('Watching ...', style: 'fg=cyan');
	}

	public function fileMoved(Event $event): void
	{
		parent::fileMoved($event);
	}

	public function fileDeleted(Event $event): void
	{
		parent::fileDeleted($event);
	}

	private function makeLint($path): void
	{
		$vendor = Path::getVendorDir();
		exec("php $vendor/bin/php-cs-fixer fix $path --quiet");
	}
}
