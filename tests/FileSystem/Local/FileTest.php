<?php

namespace Sakoo\Framework\Core\Tests\FileSystem\Local;

use Webmozart\Assert\InvalidArgumentException;

class FileTest extends FileSystemTestCase
{
	public function test_it_can_create_file()
	{
		$this->file->create();
		$this->assertFileExists($this->filePath);
		$this->assertFalse(is_dir($this->filePath));
	}

	public function test_it_can_make_directories_for_file()
	{
		$this->file->mkdir();
		$this->assertFileExists($this->parentDirPath);
	}

	public function test_it_can_check_existing_file()
	{
		$this->assertFalse($this->file->exists());

		$this->manualCreateFile(asDirectory: false);
		$this->assertTrue($this->file->exists());
	}

	public function test_it_can_remove_file()
	{
		$this->manualCreateFile(asDirectory: false);

		$this->assertFileExists($this->filePath);
		$this->assertFalse(is_dir($this->filePath));

		$this->file->remove();

		$this->assertFileDoesNotExist($this->filePath);
	}

	public function test_it_can_copy_file()
	{
		$this->manualCreateFile(asDirectory: false);
		$copyDir = $this->parentDirPath . '/another-file';

		$this->file->copy("$copyDir/test.txt");

		$this->assertFileExists("$copyDir/test.txt");
		$this->assertFileExists($this->filePath);
	}

	public function test_it_throws_exception_if_want_to_copy_not_existing_file()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File Does not Exist');

		$this->file->copy("$this->parentDirPath/another-file/test.txt");
	}

	public function test_it_can_move_file()
	{
		$this->manualCreateFile(asDirectory: false);
		$moveDir = $this->parentDirPath . '/another-file';

		$this->file->move("$moveDir/test.txt");

		$this->assertFileExists("$moveDir/test.txt");
		$this->assertFileDoesNotExist($this->filePath);
	}

	public function test_files_function_throws_exception_if_file_is_not_directory()
	{
		$this->manualCreateFile(asDirectory: false);

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File must be a Directory');

		$this->file->files();
	}

	public function test_it_can_write_to_file()
	{
		$this->manualCreateFile(asDirectory: false);

		$this->file->write('Foo');
		$this->assertStringEqualsFile($this->filePath, 'Foo');

		$this->file->write('Bar');
		$this->assertStringEqualsFile($this->filePath, 'Bar');
	}

	public function test_it_can_append_to_file()
	{
		$this->manualCreateFile(asDirectory: false);
		file_put_contents($this->filePath, 'Foo');

		$this->file->append('Bar');
		$this->assertStringEqualsFile($this->filePath, 'FooBar');

		$this->file->append('Baz');
		$this->assertStringEqualsFile($this->filePath, 'FooBarBaz');
	}

	public function test_it_returns_lines_of_file()
	{
		$this->manualCreateFile(asDirectory: false);
		file_put_contents($this->filePath, "Foo\nBar\nBaz\n");

		$lines = $this->file->readLines();
		$this->assertCount(3, $lines);
		$this->assertEquals(["Foo\n", "Bar\n", "Baz\n"], $lines);
	}

	public function test_it_throws_exception_if_want_to_read_lines_of_not_existing_file()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File Does not Exist');

		$this->file->readLines();
	}
}
