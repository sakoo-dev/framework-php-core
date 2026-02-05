<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert\Traits;

use Sakoo\Framework\Core\Str\Str;

trait FileType
{
	public static function dir(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a directory', Str::fromType($value));
		static::throwUnless(is_dir($value), $message);
	}

	public static function notDir(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a directory', Str::fromType($value));
		static::throwIf(is_dir($value), $message);
	}

	public static function file(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a file', Str::fromType($value));
		static::throwUnless(is_file($value), $message);
	}

	public static function notFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a file', Str::fromType($value));
		static::throwIf(is_file($value), $message);
	}

	public static function link(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a link', Str::fromType($value));
		static::throwUnless(is_link($value), $message);
	}

	public static function notLink(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a link', Str::fromType($value));
		static::throwIf(is_link($value), $message);
	}

	public static function uploadedFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a uploaded file', Str::fromType($value));
		static::throwUnless(is_uploaded_file($value), $message);
	}

	public static function notUploadedFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a uploaded file', Str::fromType($value));
		static::throwIf(is_uploaded_file($value), $message);
	}

	public static function executableFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a executable file', Str::fromType($value));
		static::throwUnless(is_executable($value), $message);
	}

	public static function notExecutableFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a executable file', Str::fromType($value));
		static::throwIf(is_executable($value), $message);
	}

	public static function writableFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a writable file', Str::fromType($value));
		static::throwUnless(is_writable($value), $message);
	}

	public static function notWritableFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a writable file', Str::fromType($value));
		static::throwIf(is_writable($value), $message);
	}

	public static function readableFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not a readable file', Str::fromType($value));
		static::throwUnless(is_readable($value), $message);
	}

	public static function notReadableFile(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is a readable file', Str::fromType($value));
		static::throwIf(is_readable($value), $message);
	}

	public static function exists(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is not an exists file', Str::fromType($value));
		static::throwUnless(file_exists($value), $message);
	}

	public static function notExists(string $value, string $message = ''): void
	{
		$message = $message ?: sprintf('Given value %s is an exists file', Str::fromType($value));
		static::throwIf(file_exists($value), $message);
	}
}
