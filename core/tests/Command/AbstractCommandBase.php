<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Command;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Tests\TestCase;

abstract class AbstractCommandBase extends TestCase
{
	#[Test]
	public function it_defines_correctly(): void
	{
		$this->assertInstanceOf(Command::class, $this->getCommand());
	}

	abstract protected function getCommand(): Command;
}
