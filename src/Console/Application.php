<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

use Sakoo\Framework\Core\Console\Commands\HelpCommand;
use Sakoo\Framework\Core\Console\Commands\NotFoundCommand;
use Sakoo\Framework\Core\Console\Commands\VersionCommand;
use Sakoo\Framework\Core\Console\Exceptions\CommandNotFoundException;

class Application
{
	/** @var Command[] */
	private array $commands = [];
	private ?string $defaultCommand = null;

	public function __construct(
		private readonly Input $input,
		private readonly Output $output,
	) {}

	public function run(): int
	{
		return $this->getShouldExecCommand()->run($this->input, $this->output);
	}

	/**
	 * @param Command[] $commands
	 */
	public function addCommands(array $commands): void
	{
		foreach ($commands as $command) {
			$this->addCommand($command);
		}
	}

	public function addCommand(Command $command): void
	{
		$command->setRunningApplication($this);
		$this->commands[$command::getName()] = $command;
	}

	/**
	 * @throws \Throwable
	 */
	public function setDefaultCommand(string $command): void
	{
		throwUnless(isset($this->commands[$command::getName()]), new CommandNotFoundException('Command is not in your list'));
		$this->defaultCommand = $command;
	}

	/**
	 * @return Command[]
	 */
	public function getCommands(): array
	{
		return $this->commands;
	}

	private function getShouldExecCommand(): Command
	{
		$arg = $this->input->getArgument(0);

		if ($this->shouldRunVersionCommand($arg)) {
			/**
			 * @var VersionCommand $command
			 */
			$command = resolve(VersionCommand::class);
			$command->setRunningApplication($this);

			return $command;
		}

		if ($this->shouldRunHelpCommand($arg)) {
			/**
			 * @var HelpCommand $command
			 */
			$command = resolve(HelpCommand::class);
			$command->setRunningApplication($this);

			return $command;
		}

		if (empty($arg)) {
			// @phpstan-ignore staticMethod.nonObject
			return $this->commands[$this->defaultCommand::getName()];
		}

		if (isset($this->commands[$arg])) {
			return $this->commands[$arg];
		}

		/**
		 * @var NotFoundCommand $command
		 */
		$command = resolve(NotFoundCommand::class);
		$command->setRunningApplication($this);

		return $command;
	}

	private function shouldRunVersionCommand(?string $arg): bool
	{
		return $this->input->hasOption('version') || VersionCommand::getName() === $arg || $this->input->hasOption('v');
	}

	private function shouldRunHelpCommand(?string $arg): bool
	{
		return $this->input->hasOption('help') || HelpCommand::getName() === $arg || (is_null($arg) && is_null($this->defaultCommand)) || $this->input->hasOption('h');
	}
}
