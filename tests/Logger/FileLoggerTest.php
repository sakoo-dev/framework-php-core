<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Logger;

use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

final class FileLoggerTest extends TestCase
{
	private string $dir;
	private string $file;

	protected function setUp(): void
	{
		Clock::setTestNow('2022-01-01 00:00:00');

		$this->dir = Path::getTempTestDir() . '/log/';
		$this->file = $this->dir . (new Clock())->now()->format('Y/m/d') . '.log';

		$this->resetFileSystemTestEnv();
	}

	protected function tearDown(): void
	{
		$this->resetFileSystemTestEnv();
	}

	public function getLogLevels()
	{
		yield ['emergency'];
		yield ['alert'];
		yield ['critical'];
		yield ['error'];
		yield ['warning'];
		yield ['notice'];
		yield ['info'];
		yield ['debug'];
	}

	/** @dataProvider getLogLevels */
	public function test_it_can_log_to_file($level)
	{
		$message = rand(0, 9999);
		logger()->{$level}("$message");
		$this->assertEquals($this->getFormattedLog($level, "$message"), file_get_contents($this->file));
	}

	private function getFormattedLog(string $level, string $message): string
	{
		$clock = new Clock();

		return '[' . $clock->now()->format(\DateTime::ATOM) . '] [' . strtoupper($level) . "] [Test Debug] - $message" . PHP_EOL;
	}

	private function resetFileSystemTestEnv(): void
	{
		File::open(Disk::Local, $this->dir)
			->remove();
	}
}
