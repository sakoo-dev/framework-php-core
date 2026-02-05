<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\FileSystem\Local;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;

final class FileTest extends FileSystemTestCase
{
	use HasPermissions;

	#[Test]
	public function it_can_create_file()
	{
		$this->file->create();
		$this->assertFileExists($this->filePath);
		$this->assertFalse(is_dir($this->filePath));
	}

	#[Test]
	public function it_can_make_directories_for_file()
	{
		$this->file->mkdir();
		$this->assertFileExists($this->parentDirPath);
	}

	#[Test]
	public function it_can_check_existing_file()
	{
		$this->assertFalse($this->file->exists());

		$this->createFile();
		$this->assertTrue($this->file->exists());
	}

	#[Test]
	public function it_can_remove_file()
	{
		$this->createFile();

		$this->assertFileExists($this->filePath);
		$this->assertFalse(is_dir($this->filePath));

		$this->file->remove();

		$this->assertFileDoesNotExist($this->filePath);
	}

	#[Test]
	public function it_can_copy_file()
	{
		$this->createFile();
		$copyDir = $this->parentDirPath . '/another-file';

		$this->file->copy("$copyDir/test.txt");

		$this->assertFileExists("$copyDir/test.txt");
		$this->assertFileExists($this->filePath);
	}

	#[Test]
	public function it_throws_exception_if_want_to_copy_not_existing_file()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File Does not Exist');

		$this->file->copy("$this->parentDirPath/another-file/test.txt");
	}

	#[Test]
	public function it_can_move_file()
	{
		$this->createFile();
		$moveDir = $this->parentDirPath . '/another-file';

		$this->file->move("$moveDir/test.txt");

		$this->assertFileExists("$moveDir/test.txt");
		$this->assertFileDoesNotExist($this->filePath);
	}

	#[Test]
	public function files_function_throws_exception_if_file_is_not_directory()
	{
		$this->createFile();

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File must be a Directory');

		$this->file->files();
	}

	#[Test]
	public function it_can_write_to_file()
	{
		$this->createFile();

		$this->file->write('Foo');
		$this->assertStringEqualsFile($this->filePath, 'Foo');

		$this->file->write('Bar');
		$this->assertStringEqualsFile($this->filePath, 'Bar');
	}

	#[Test]
	public function it_can_append_to_file()
	{
		$this->createFile();
		file_put_contents($this->filePath, 'Foo');

		$this->file->append('Bar');
		$this->assertStringEqualsFile($this->filePath, 'FooBar');

		$this->file->append('Baz');
		$this->assertStringEqualsFile($this->filePath, 'FooBarBaz');
	}

	#[Test]
	public function it_returns_lines_of_file()
	{
		$this->createFile();
		file_put_contents($this->filePath, "Foo\nBar\nBaz\n");

		$lines = $this->file->readLines();
		$this->assertCount(3, $lines);
		$this->assertEquals(["Foo\n", "Bar\n", "Baz\n"], $lines);
	}

	#[Test]
	public function it_throws_exception_if_want_to_read_lines_of_not_existing_file()
	{
		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('File Does not Exist');

		$this->file->readLines();
	}

	#[Test]
	public function it_can_return_file_path()
	{
		$this->createFile();
		$this->assertEquals($this->filePath, $this->file->getPath());
	}
}
