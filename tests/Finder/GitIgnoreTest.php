<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Finder;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Finder\GitIgnore;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

final class GitIgnoreTest extends TestCase
{
	private string $tempDir;
	private string $gitignorePath;

	protected function setUp(): void
	{
		parent::setUp();

		$this->tempDir = Path::getTempTestDir() . '/gitignore_' . uniqid();
		File::open(Disk::Local, $this->tempDir)->create(true);

		$this->gitignorePath = $this->tempDir . '/.gitignore';

		file_put_contents($this->gitignorePath, implode("\n", [
			'# comment line',
			'*.log',
			'cache/',
			'!important.log',
			'/rooted.txt',
			'data/**/*.json',
			'*.tmp',
			'folder/*.txt',
			'!folder/keep.txt',
		]));

		file_put_contents($this->tempDir . '/error.log', 'error');
		file_put_contents($this->tempDir . '/important.log', 'keep');
		file_put_contents($this->tempDir . '/rooted.txt', 'rooted');
		file_put_contents($this->tempDir . '/temp.tmp', 'tmp');
		file_put_contents($this->tempDir . '/file.txt', 'normal');

		mkdir($this->tempDir . '/cache');
		file_put_contents($this->tempDir . '/cache/temp.txt', 'cached');

		mkdir($this->tempDir . '/data');
		mkdir($this->tempDir . '/data/level1');
		mkdir($this->tempDir . '/data/level1/level2');
		file_put_contents($this->tempDir . '/data/level1/level2/item.json', 'json');

		mkdir($this->tempDir . '/folder');
		file_put_contents($this->tempDir . '/folder/a.txt', 'text');
		file_put_contents($this->tempDir . '/folder/keep.txt', 'text');
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		File::open(Disk::Local, $this->tempDir)->remove();
	}

	#[Test]
	public function ignore_log_files(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/error.log'));
		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/important.log'));
		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/file.txt'));
	}

	#[Test]
	public function ignore_directory(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/cache'));
		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/cache/temp.txt'));
		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/file.txt'));
	}

	#[Test]
	public function negation_rule(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/important.log'));
	}

	#[Test]
	public function rooted_pattern_only_matches_root(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/rooted.txt'));
		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/data/rooted.txt'));
	}

	#[Test]
	public function double_star_matches_nested_directories(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/data/level1/level2/item.json'));
		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/file.txt'));
	}

	#[Test]
	public function folder_specific_pattern(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/folder/a.txt'));
		$this->assertFalse($gitIgnore->isIgnored($this->tempDir . '/folder/keep.txt'));
	}

	#[Test]
	public function tmp_extension_is_ignored(): void
	{
		$gitIgnore = new GitIgnore($this->gitignorePath);

		$this->assertTrue($gitIgnore->isIgnored($this->tempDir . '/temp.tmp'));
	}

	#[Test]
	public function gitignore_file_not_found(): void
	{
		$this->expectException(InvalidArgumentException::class);

		new GitIgnore($this->tempDir . '/no.gitignore');
	}
}
