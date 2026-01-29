<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\FileSystem;

class Permission
{
	final public const int NOTHING = 0;
	final public const int EXECUTE = 1;
	final public const int WRITE = 2;
	final public const int EXECUTE_WRITE = 3;
	final public const int READ = 4;
	final public const int EXECUTE_READ = 5;
	final public const int WRITE_READ = 6;
	final public const int EXECUTE_WRITE_READ = 7;

	public static function allNothing(): string
	{
		return static::make(static::NOTHING, static::NOTHING, static::NOTHING);
	}

	public static function allExecute(): string
	{
		return static::make(static::EXECUTE, static::EXECUTE, static::EXECUTE);
	}

	public static function allWrite(): string
	{
		return static::make(static::WRITE, static::WRITE, static::WRITE);
	}

	public static function allExecuteWrite(): string
	{
		return static::make(static::EXECUTE_WRITE, static::EXECUTE_WRITE, static::EXECUTE_WRITE);
	}

	public static function allRead(): string
	{
		return static::make(static::READ, static::READ, static::READ);
	}

	public static function allExecuteRead(): string
	{
		return static::make(static::EXECUTE_READ, static::EXECUTE_READ, static::EXECUTE_READ);
	}

	public static function allWriteRead(): string
	{
		return static::make(static::WRITE_READ, static::WRITE_READ, static::WRITE_READ);
	}

	public static function allExecuteWriteRead(): string
	{
		return static::make(static::EXECUTE_WRITE_READ, static::EXECUTE_WRITE_READ, static::EXECUTE_WRITE_READ);
	}

	/**
	 * @return string[]
	 */
	public static function getExecutables(): array
	{
		return [static::allExecuteWriteRead(), static::allExecuteRead(), static::allExecuteWrite(), static::allExecute()];
	}

	/**
	 * @return string[]
	 */
	public static function getNotExecutables(): array
	{
		return [static::allWriteRead(), static::allRead(), static::allWrite(), static::allNothing()];
	}

	/**
	 * @return string[]
	 */
	public static function getWritables(): array
	{
		return [static::allExecuteWriteRead(), static::allWriteRead(), static::allExecuteWrite(), static::allWrite()];
	}

	/**
	 * @return string[]
	 */
	public static function getNotWritables(): array
	{
		return [static::allExecuteRead(), static::allRead(), static::allExecute(), static::allNothing()];
	}

	/**
	 * @return string[]
	 */
	public static function getReadables(): array
	{
		return [static::allExecuteWriteRead(), static::allWriteRead(), static::allExecuteRead(), static::allRead()];
	}

	/**
	 * @return string[]
	 */
	public static function getNotReadables(): array
	{
		return [static::allExecuteWrite(), static::allWrite(), static::allExecute(), static::allNothing()];
	}

	public static function make(int $user, int $group, int $others): string
	{
		return '0' . $user . $group . $others;
	}

	public static function getFileDefault(): string
	{
		return static::make(static::WRITE_READ, static::READ, static::READ);
	}

	public static function getDirectoryDefault(): string
	{
		return static::make(static::EXECUTE_WRITE_READ, static::EXECUTE_READ, static::EXECUTE_READ);
	}
}
