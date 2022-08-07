<?php

namespace Tests\Path;

use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Testing\TestCase;

class PathTest extends TestCase
{
	private string $root;

	public function setUp(): void
	{
		parent::setUp();
		$this->root = realpath(__DIR__ . '/../..');
	}

	public function test_it_returns_root_dir_path_properly()
	{
		$this->assertEquals($this->root, Path::getRootDir());
	}

	public function test_it_returns_core_dir_path_properly()
	{
		$this->assertEquals("{$this->root}/src", Path::getCoreDir());
	}

	public function test_it_returns_core_apps_path_properly()
	{
		$this->assertEquals("{$this->root}/apps", Path::getAppsDir());
	}

	public function test_it_returns_core_vendor_path_properly()
	{
		$this->assertEquals("{$this->root}/vendor", Path::getVendorDir());
	}

	public function test_it_returns_core_storage_path_properly()
	{
		$this->assertEquals("{$this->root}/storage", Path::getStorageDir());
	}
}
