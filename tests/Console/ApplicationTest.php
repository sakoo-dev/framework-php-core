<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Console;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Command\ZenCommand;
use Sakoo\Framework\Core\Console\Application;
use Sakoo\Framework\Core\Console\Exceptions\CommandNotFoundException;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Constants;
use Sakoo\Framework\Core\Tests\TestCase;

final class ApplicationTest extends TestCase
{
	#[DataProvider('versionArgsProvider')]
	#[Test]
	public function it_loads_console_properly($arg)
	{
		$input = new Input([$arg]);
		$output = new Output();
		$output->setSilentMode(true);

		$console = new Application($input, $output);
		$status = $console->run();
		$result = $output->getDisplay();

		$this->assertEquals(Output::SUCCESS, $status);
		$this->assertStringContainsString(Constants::FRAMEWORK_NAME . ' - Version: ' . Constants::FRAMEWORK_VERSION, $result);
	}

	#[DataProvider('helpArgsProvider')]
	#[Test]
	public function it_loads_help_command_properly($arg)
	{
		$input = new Input([$arg]);
		$output = new Output();
		$output->setSilentMode(true);

		$console = new Application($input, $output);
		$status = $console->run();
		$result = $output->getDisplay();

		$this->assertEquals(Output::SUCCESS, $status);
		$this->assertStringContainsString('Available commands:', $result);
	}

	#[Test]
	public function it_loads_default_command_properly()
	{
		$input = new Input([]);
		$output = new Output();
		$output->setSilentMode(true);

		$console = new Application($input, $output);
		$console->addCommand(resolve(ZenCommand::class));
		$console->setDefaultCommand(ZenCommand::class);
		$status = $console->run();
		$result = $output->getDisplay();

		$this->assertEquals(Output::SUCCESS, $status);
		$this->assertStringContainsString(Constants::FRAMEWORK_NAME . ' (Version: ' . Constants::FRAMEWORK_VERSION . ')', $result);
		$this->assertStringContainsString('Copyright ' . date('Y') . ' by ' . Constants::AUTHOR, $result);
	}

	#[Test]
	public function it_loads_not_found_command_properly()
	{
		$input = new Input(['Something']);
		$output = new Output();
		$output->setSilentMode(true);

		$console = new Application($input, $output);
		$status = $console->run();
		$result = $output->getDisplay();

		$this->assertEquals(Output::ERROR, $status);
		$this->assertStringContainsString('Requested command has not found.', $result);
		$this->assertStringContainsString('try "./assist help" to get more information', $result);
	}

	#[Test]
	public function it_throws_exception_if_default_command_not_found()
	{
		$this->expectException(CommandNotFoundException::class);

		$input = new Input([]);
		$output = new Output();
		$output->setSilentMode(true);

		$console = new Application($input, $output);
		$console->setDefaultCommand(ZenCommand::class);
	}

	public function versionArgsProvider(): \Generator
	{
		yield ['version'];
		yield ['-version'];
		yield ['--version'];
		yield ['-v'];
		yield ['--v'];
	}

	public function helpArgsProvider(): \Generator
	{
		yield ['help'];
		yield ['-help'];
		yield ['--help'];
		yield ['-h'];
		yield ['--h'];
	}
}
