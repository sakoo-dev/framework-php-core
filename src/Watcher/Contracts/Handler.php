<?php

namespace Sakoo\Framework\Core\Watcher\Contracts;

use Sakoo\Framework\Core\Utilities\Locker;

interface Handler
{
	public function getId(): int;

	public function getCallback(): callable;

	public function getFile(): string;

	public function getLocker(): Locker;
}
