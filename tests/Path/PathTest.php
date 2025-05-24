<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Path;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

final class PathTest extends TestCase
{
	private string $root;

	protected function setUp(): void
	{
		parent::setUp();
		$this->root = realpath(__DIR__ . '/../../');
	}

	#[Test]
	public function it_returns_root_dir_path_properly(): void
	{
		$this->assertEquals($this->root, Path::getRootDir());
	}

	#[Test]
	public function it_returns_core_dir_path_properly(): void
	{
		$this->assertEquals("{$this->root}/src", Path::getCoreDir());
	}

	#[Test]
	public function it_returns_core_vendor_path_properly(): void
	{
		$this->assertEquals("{$this->root}/vendor", Path::getVendorDir());
	}

	#[Test]
	public function it_returns_core_storage_path_properly(): void
	{
		$this->assertEquals("{$this->root}/storage", Path::getStorageDir());
	}

	#[Test]
	public function it_returns_core_logs_path_properly(): void
	{
		$this->assertEquals("{$this->root}/storage/logs", Path::getLogsDir());
	}

	#[Test]
	public function it_returns_temp_test_path_properly(): void
	{
		$this->assertEquals('/tmp/sakoo-test', Path::getTempTestDir());
	}

	#[Test]
	public function it_returns_all_php_files_properly(): void
	{
		$files = Path::getProjectPHPFiles();
		$this->assertGreaterThan(20, count($files));
	}

	#[Test]
	public function it_returns_php_core_files(): void
	{
		$files = Path::getCorePHPFiles();
		$this->assertGreaterThan(20, count($files));
	}

	#[Test]
	public function it_returns_php_files_of_somewhere(): void
	{
		$files = Path::getPHPFilesOf($this->root);
		$this->assertGreaterThan(20, count($files));
	}
}
