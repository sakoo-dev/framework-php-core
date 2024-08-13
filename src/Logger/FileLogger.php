<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Logger;

use Psr\Log\AbstractLogger;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;

class FileLogger extends AbstractLogger
{
	public function log($level, string|\Stringable $message, array $context = []): void
	{
		$log = $this->getFormattedLog($level, $message);
		$this->writeToFile($log);
	}

	private function getFormattedLog($level, string|\Stringable $message): string
	{
		$env = kernel()->getEnvironment()->value;
		$mode = kernel()->getMode()->value;

		return (string) new LogFormatter($level, $message, $mode, $env);
	}

	private function writeToFile(string $log): bool
	{
		return File::open(Disk::Local, $this->getLogFileName())
			->append($log . PHP_EOL);
	}

	private function getLogFileName(): string
	{
		$path = Path::getLogsDir();

		if (kernel()->isInTestMode()) {
			$path = Path::getTempTestDir() . '/log';
		}

		return "$path/" . (new Clock())->now()->format('Y/m/d') . '.log';
	}
}
