<?php

namespace Sakoo\Framework\Core\Tests\Utilities;

use Sakoo\Framework\Core\Testing\TestCase;
use Sakoo\Framework\Core\Utilities\Locker;

class LockerTest extends TestCase
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
