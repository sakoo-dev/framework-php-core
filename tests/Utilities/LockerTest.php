<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Utilities;

use Sakoo\Framework\Core\Tests\TestCase;
use Sakoo\Framework\Core\Utilities\Locker;

final class LockerTest extends TestCase
{
	public function test_locker_works_properly()
	{
		$locker = new Locker();
		$this->assertFalse($locker->isLocked());

		$locker->lock();
		$this->assertTrue($locker->isLocked());

		$locker->unlock();
		$this->assertFalse($locker->isLocked());
	}
}
