<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Finder;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Finder\FileFinder;
use Sakoo\Framework\Core\Finder\SplFileObject;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

final class FileFinderTest extends TestCase
{
	private string $tempDir;

	protected function setUp(): void
	{
		parent::setUp();

		$this->tempDir = Path::getTempTestDir() . '/filefinder_test_' . uniqid();
		$fileManager = File::open(Disk::Local, $this->tempDir);
		$fileManager->create(true);

		mkdir($this->tempDir . '/.git');
		mkdir($this->tempDir . '/subdir');

		file_put_contents($this->tempDir . '/file1.txt', 'hello');
		file_put_contents($this->tempDir . '/file2.php', '<?php echo 1;');
		file_put_contents($this->tempDir . '/subdir/file3.txt', 'sub');
		file_put_contents($this->tempDir . '/.hidden', 'hidden');
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		File::open(Disk::Local, $this->tempDir)->remove();
	}

	#[Test]
	public function get_all_files(): void
	{
		$finder = new FileFinder($this->tempDir);
		$files = $finder->getFiles();

		$this->assertCount(4, $files);

		foreach ($files as $file) {
			$this->assertInstanceOf(SplFileObject::class, $file);

			$this->assertContains($file->getRealPath(), [
				$this->tempDir . '/file1.txt',
				$this->tempDir . '/file2.php',
				$this->tempDir . '/subdir/file3.txt',
				$this->tempDir . '/.hidden',
			]);
		}
	}

	#[Test]
	public function find(): void
	{
		$finder = new FileFinder($this->tempDir);
		$files = $finder->find();

		$this->assertCount(4, $files);

		foreach ($files as $file) {
			$this->assertContains($file, [
				$this->tempDir . '/file1.txt',
				$this->tempDir . '/file2.php',
				$this->tempDir . '/subdir/file3.txt',
				$this->tempDir . '/.hidden',
			]);
		}
	}

	#[Test]
	public function ignore_dot_files(): void
	{
		$finder = (new FileFinder($this->tempDir))->ignoreDotFiles();
		$files = $finder->getFiles();

		foreach ($files as $file) {
			$this->assertStringNotContainsString('.hidden', $file->getRealPath());
			$this->assertStringNotContainsString('.git', $file->getRealPath());
		}
	}

	#[Test]
	public function pattern_matching(): void
	{
		$finder = (new FileFinder($this->tempDir))->pattern('*.php');
		$files = $finder->getFiles();

		$this->assertCount(1, $files);
		$this->assertStringEndsWith('file2.php', $files[0]->getRealPath());
	}

	#[Test]
	public function ignore_vcs(): void
	{
		$finder = (new FileFinder($this->tempDir))->ignoreVCS();
		$files = $finder->getFiles();

		$dotHiddenFound = false;

		foreach ($files as $file) {
			if ('.hidden' === $file->getFilename()) {
				$dotHiddenFound = true;
			}
			$this->assertStringNotContainsString('.git', $file->getRealPath());
		}

		$this->assertTrue($dotHiddenFound);
	}
}
