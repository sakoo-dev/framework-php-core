<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\FileSystem\Local;

use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;

final class DirectoryTest extends FileSystemTestCase
{
	use HasPermissions;

	public function test_it_can_create_directory()
	{
		$this->file->create(asDirectory: true);
		$this->assertFileExists($this->filePath);
		$this->assertTrue(is_dir($this->filePath));
	}

	public function test_it_can_check_existing_directory()
	{
		$this->assertFalse($this->file->exists());

		$this->createDirectory();
		$this->assertTrue($this->file->exists());
	}

	public function test_it_can_remove_directory()
	{
		$this->createDirectory();

		$this->assertFileExists($this->filePath);
		$this->assertTrue(is_dir($this->filePath));

		$this->file->remove();
		$this->assertFileDoesNotExist($this->filePath);
	}

	public function test_it_can_check_that_file_is_a_directory()
	{
		$this->createDirectory();

		$this->assertTrue($this->file->isDir());

		rmdir($this->filePath);
		touch($this->filePath);

		$this->assertFalse($this->file->isDir());
	}

	public function test_it_can_copy_directory()
	{
		$this->createDirectory();
		$copyDir = $this->parentDirPath . '/another-file';

		$this->file->copy("$copyDir/test-dir");

		$this->assertDirectoryExists("$copyDir/test-dir");
		$this->assertDirectoryExists($this->filePath);
	}

	public function test_it_throws_exception_if_want_to_copy_not_existing_directory()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File Does not Exist');

		$this->file->copy("$this->parentDirPath/another-file/test-dir");
	}

	public function test_it_can_move_directory()
	{
		$this->createDirectory();
		$moveDir = $this->parentDirPath . '/another-file';

		$this->file->move("$moveDir/test-dir");

		$this->assertDirectoryExists("$moveDir/test-dir");
		$this->assertDirectoryDoesNotExist($this->filePath);
	}

	public function test_files_function_returns_content_of_a_directory()
	{
		$this->createDirectory();
		$names = set([
			"$this->filePath/foo",
			"$this->filePath/bar",
			"$this->filePath/baz",
			"$this->filePath/dev",
		]);

		$names->each(fn ($name) => touch($name));

		$files = $this->file->files();

		$this->assertCount($names->count(), $files);
		$this->assertEqualsCanonicalizing($names->toArray(), $files);
	}

	public function test_it_throws_exception_if_want_to_write_to_directory()
	{
		$this->createDirectory();

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File could not be a Directory');

		$this->file->write('Something');
	}

	public function test_it_throws_exception_if_want_to_append_to_directory()
	{
		$this->createDirectory();

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File could not be a Directory');

		$this->file->append('Something');
	}

	public function test_it_throws_exception_if_want_to_read_lines_of_directory()
	{
		$this->createDirectory();

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File could not be a Directory');

		$this->file->readLines();
	}

	public function test_it_can_return_directory_path()
	{
		$this->createDirectory();
		$this->assertEquals($this->filePath, $this->file->getPath());
	}
}
