<?php

namespace Sakoo\Framework\Core\Console\WatcherActions;

use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Watcher\Contracts\Event;
use Sakoo\Framework\Core\Watcher\Contracts\Handler;
use Sakoo\Framework\Core\Watcher\EventTypes;
use Symfony\Component\Console\Style\SymfonyStyle;

class PhpBundle
{
	public function __construct(private SymfonyStyle $style)
	{
	}

	public function __invoke(Event $event, Handler $handler)
	{
		match ($event->getType()) {
			EventTypes::MODIFY => $this->fileModify($event, $handler),
		};
	}

	private function fileModify(Event $event, Handler $handler)
	{
		$file = $handler->getFile();
		$this->style->block("$file changed at " . date('H:i:s'), style: 'fg=green');
		$this->makeStyleFix($file);
		$handler->getLocker()->unlock();
		$this->style->block('Watching ...', style: 'fg=cyan');
	}

	private function makeStyleFix($path): void
	{
		$vendor = Path::getVendorDir();
		exec("php $vendor/bin/php-cs-fixer fix $path --quiet");
	}
}
