<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Command;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Command\DocGenCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Tests\TestCase;

final class DocGenCommandTest extends TestCase
{
	#[Test]
	public function it_defines_correctly(): void
	{
		$command = new DocGenCommand();
		$this->assertInstanceOf(Command::class, $command);
	}
}
