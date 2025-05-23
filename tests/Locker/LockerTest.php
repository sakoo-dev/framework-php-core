<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Locker;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Locker\Locker;
use Sakoo\Framework\Core\Tests\TestCase;

final class LockerTest extends TestCase
{
	#[Test]
	public function locker_works_properly(): void
	{
		$locker = new Locker();
		$this->assertFalse($locker->isLocked());

		$locker->lock();
		$this->assertTrue($locker->isLocked());

		$locker->unlock();
		$this->assertFalse($locker->isLocked());
	}
}
