<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Logger;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
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
		parent::setUp();
		Clock::setTestNow('2022-01-01 00:00:00');

		$this->dir = Path::getLogsDir();
		$this->file = $this->dir . '/' . (new Clock())->now()->format('Y/m/d') . '.log';

		$this->resetFileSystemTestEnv();
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		$this->resetFileSystemTestEnv();
	}

	#[DataProvider('getLogLevels')]
	#[Test]
	public function it_can_log_to_file($level): void
	{
		$message = rand(0, 9999);
		logger()->{$level}("$message");
		$this->assertStringContainsString($this->getFormattedLog($level, "$message"), file_get_contents($this->file));
	}

	public static function getLogLevels(): \Generator
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

	private function getFormattedLog(string $level, string $message): string
	{
		$clock = new Clock();

		return '[' . $clock->now()->format(\DateTime::ATOM) . '] [' . strtoupper($level) . "] [Test Debug] - $message" . PHP_EOL;
	}

	private function resetFileSystemTestEnv(): void
	{
		File::open(Disk::Local, $this->dir)->remove();
	}
}
