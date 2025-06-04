<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\FileSystem;

interface Storage
{
	public function create(bool $asDirectory = false): bool;

	public function mkdir(bool $recursive = true): bool;

	public function exists(): bool;

	public function remove(): bool;

	public function isDir(): bool;

	public function move(string $to): bool;

	public function copy(string $to): bool;

	public function files(): array;

	public function parentDir(): string;

	public function rename(string $to): bool;

	public function write(string $data): bool;

	public function append(string $data): bool;

	public function readLines(): array|false;

	public function setPermission(int|string $permission): bool;

	public function getPermission(): mixed;

	public function getPath(): string;
}
