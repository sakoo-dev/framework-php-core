<?php

namespace Sakoo\Framework\Core\Tests\Logger;

use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

class FileLoggerTest extends TestCase
{
	private string $dir;
	private string $file;

	protected function setUp(): void
	{
		$this->dir = Path::getStorageDir() . '/tests/log/';
		$this->file = $this->dir . date('Y/m/d') . '.log';

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
		Clock::setTestNow('2022-01-01 00:00:00');

		$message = rand(0, 9999);
		logger()->{$level}($message);
		$this->assertEquals($this->getFormattedLog($level, $message), file_get_contents($this->file));
	}

	private function getFormattedLog(string $level, string $message): string
	{
		$clock = new Clock();
		return $clock->now()->format('Y-m-d H:i:s') . ' - Test Debug - ' . strtoupper($level) . ' - ' . $message . PHP_EOL;
	}

	private function resetFileSystemTestEnv(): void
	{
		File::open(Disk::Local, $this->dir)
			->remove();
	}
}
