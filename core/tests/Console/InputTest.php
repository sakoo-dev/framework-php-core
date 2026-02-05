<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Console;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Tests\TestCase;

final class InputTest extends TestCase
{
	#[Test]
	public function args_parse_correctly(): void
	{
		$_SERVER['argv'] = ['command', 'arg', '--option'];
		$input = new Input();

		$this->assertEquals(['arg'], $input->getArguments());
		$this->assertEquals('arg', $input->getArgument(0));

		$this->assertEquals('true', $input->getOption('option'));
		$this->assertArrayHasKey('option', $input->getOptions());
		$this->assertTrue($input->hasOption('option'));
	}
}
