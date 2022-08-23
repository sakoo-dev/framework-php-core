<?php

namespace Sakoo\Framework\Core\Console\WatcherActions;

use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\WatcherActions;
use Symfony\Component\Console\Style\SymfonyStyle;

class PhpBundler extends WatcherActions
{
	public function __construct(private SymfonyStyle $style)
	{
	}

	public function fileModified(Event $event)
	{
		parent::fileModified($event);

		$path = $event->getFile()->getPath();
		$this->style->block("$path changed at " . date('H:i:s'), style: 'fg=green');

		$this->makeStyleFix($path);

		$event->getFile()->getLocker()->unlock();
		$this->style->block('Watching ...', style: 'fg=cyan');
	}

	public function fileMoved(Event $event)
	{
		parent::fileMoved($event);
	}

	public function fileDeleted(Event $event)
	{
		parent::fileDeleted($event);
	}

	private function makeStyleFix($path): void
	{
		$vendor = Path::getVendorDir();
		exec("php $vendor/bin/php-cs-fixer fix $path --quiet");
	}
}
