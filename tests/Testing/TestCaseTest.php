<?php

namespace Sakoo\Framework\Core\Tests\Testing;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Kernel\Environment;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Testing\TestCase;

class TestCaseTest extends TestCase
{
	public function test_kernel_is_loaded_properly()
	{
		$this->assertInstanceOf(Kernel::class, self::$kernel);
		$this->assertSame(Environment::Test, self::$kernel->environment);
		$this->assertInstanceOf(Container::class, self::$kernel->container);
		$this->assertGreaterThan(0, self::$kernel->startTime);
	}
}
