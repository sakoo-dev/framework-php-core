<?php

namespace Sakoo\Framework\Core\Testing;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sakoo\Framework\Core\Kernel\Environment;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Testing\Traits\AssistantTester;

abstract class TestCase extends PHPUnitTestCase
{
	use AssistantTester;

	protected static ?Kernel $kernel = null;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();
		static::$kernel ??= Kernel::run(Environment::Test);
	}
}
