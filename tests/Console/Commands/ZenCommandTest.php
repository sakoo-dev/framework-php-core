<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Console\Commands;

use Sakoo\Framework\Core\Constants;
use Sakoo\Framework\Core\Tests\TestCase;

final class ZenCommandTest extends TestCase
{
	public function test_it_loads_zen_command_properly()
	{
		$commandTester = $this->getAssistantApplication(['zen']);
		$commandTester->assertCommandIsSuccessful();
		$result = $commandTester->getDisplay();

		$this->assertStringContainsString(Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')', $result);
		$this->assertStringContainsString('Copyright ' . date('Y') . ' by ' . Constants::AUTHOR, $result);
	}
}
