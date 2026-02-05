<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Sakoo\Framework\Core\Clock\Clock;
use Sakoo\Framework\Core\Testing\Traits\FileAssertions;
use Sakoo\Framework\Core\Testing\Traits\HelperAssertions;

abstract class TestCase extends PHPUnitTestCase implements NeedsKernel
{
	use FileAssertions;
	use HelperAssertions;

	private static bool $initialized = false;

	public static function setUpBeforeClass(): void
	{
		parent::setUpBeforeClass();

		if (!self::$initialized) {
			static::runKernel();
			self::$initialized = true;

			logger()->info('Automated Tests are ready to Run!');
		}
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		Clock::setTestNow();
	}
}
