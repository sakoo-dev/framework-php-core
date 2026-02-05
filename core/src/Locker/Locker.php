<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Locker;

class Locker
{
	private bool $locked = false;

	public function lock(): void
	{
		$this->locked = true;
	}

	public function unlock(): void
	{
		$this->locked = false;
	}

	public function isLocked(): bool
	{
		return $this->locked;
	}
}
