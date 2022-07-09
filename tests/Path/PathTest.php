<?php

namespace Tests\Path;

use Core\Path\Path;
use Core\Testing\TestCase;

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
}
