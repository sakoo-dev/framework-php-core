<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher\Contracts;

use Sakoo\Framework\Core\Locker\Locker;

interface File
{
	public function getId(): int;

	public function getCallback(): FileSystemAction;

	public function getPath(): string;

	public function getLocker(): Locker;
}
