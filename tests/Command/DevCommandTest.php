<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Command;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Command\DevCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Tests\TestCase;

final class DevCommandTest extends TestCase
{
	#[Test]
	public function it_defines_correctly(): void
	{
		$command = new DevCommand();
		$this->assertInstanceOf(Command::class, $command);
	}
}
