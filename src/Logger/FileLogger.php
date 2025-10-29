<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Logger;

use Psr\Log\AbstractLogger;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Exception\Exception;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;

class FileLogger extends AbstractLogger
{
	/**
	 * @param string $level
	 *
	 * @throws \Exception|\Throwable
	 */
	public function log($level, string|\Stringable $message, array $context = []): void
	{
		$log = $this->getFormattedLog($level, $message);
		$isWritten = $this->writeToFile($log);
		throwUnless($isWritten, new Exception('Failed to write log file.'));
	}

	private function getFormattedLog(string $level, string|\Stringable $message): string
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
		return Path::getLogsDir() . '/' . (new Clock())->now()->format('Y/m/d') . '.log';
	}
}
