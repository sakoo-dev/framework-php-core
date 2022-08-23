<?php

namespace Sakoo\Framework\Core\Watcher\Contracts;

use Sakoo\Framework\Core\Watcher\EventTypes;

interface Event
{
	public function getFile(): File;

	public function getHandlerId(): int;

	public function getType(): EventTypes;

	public function getName(): string;
}
