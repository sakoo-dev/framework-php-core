<?php

namespace Sakoo\Framework\Core\Logger;

use Psr\Log\AbstractLogger;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;

class FileLogger extends AbstractLogger
{
	public function log($level, \Stringable|string $message, array $context = []): void
	{
		$log = $this->getFormattedLog($level, $message);
		$this->writeToFile($log);
	}

	private function getFormattedLog($level, \Stringable|string $message): string
	{
		$env = kernel()->getEnvironment()->value;
		$mode = kernel()->getMode()->value;

		return new LogFormatter($level, $message, $mode, $env);
	}

	private function writeToFile(string $log): bool
	{
		return File::open(Disk::Local, $this->getLogFileName())
			->append($log . PHP_EOL);
	}

	private function getLogFileName(): string
	{
		return kernel()->isInTestMode() ?
			Path::getStorageDir() . '/tests/log/' . date('Y/m/d') . '.log' :
			Path::getLogsDir() . '/' . date('Y/m/d') . '.log';
	}
}
