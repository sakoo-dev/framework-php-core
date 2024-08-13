<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Testing\Traits\AssistantTester;
use Sakoo\Framework\Core\Testing\Traits\FileAssertions;
use Sakoo\Framework\Core\Testing\Traits\HelperAssertions;

abstract class TestCase extends PHPUnitTestCase implements NeedsKernel
{
	use AssistantTester;
	use FileAssertions;
	use HelperAssertions;

	private static bool $initialized = false;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		if (!static::$initialized) {
			static::runKernel();
			static::$initialized = true;

			logger()->info('Sakoo is prepared for Launching!');
		}
	}

	protected function tearDown(): void
	{
		Clock::setTestNow();
	}
}
