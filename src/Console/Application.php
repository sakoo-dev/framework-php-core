<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

use Sakoo\Framework\Core\Command\NoCommand;

class Application
{
	private array $commands = [];
	private string $defaultCommand;
	private string $name;
	private string $version;
	private bool $autoExit;

	public function run($input = null, $options = null): int
	{
		$result = 1;

		$isRan = false;
		$args = $input;

		if (empty($args)) {
			$args = $_SERVER['argv'];
			array_shift($args);
		}

		if (empty($args)) {
			$isRan = true;
			$result = resolve($this->defaultCommand)->run(new Input(), new Output());
		} else {
			$command = $args[0];
			array_shift($args);

			if (str_starts_with($command, '--')) {
				if ('--version' === $command) {
					echo $this->name . ' ' . $this->version;

					return 0;
				}

				return 1;
			}

			foreach ($this->commands as $cmd) {
				if ($cmd->getDefaultName() === $command) {
					$isRan = true;
					$result = $cmd->run(new Input($args), new Output());

					break;
				}
			}
		}

		if (!$isRan) {
			$result = resolve(NoCommand::class)->run(new Input(), new Output());
		}

		return $result;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function setVersion(string $version): void
	{
		$this->version = $version;
	}

	public function setAutoExit(bool $autoExit): void
	{
		$this->autoExit = $autoExit;
	}

	public function addCommands(array $commands): void
	{
		foreach ($commands as $command) {
			$this->addCommand($command);
		}
	}

	public function addCommand(Command $command): void
	{
		$this->commands[] = $command;
	}

	public function setDefaultCommand(string $command): void
	{
		foreach ($this->commands as $cmd) {
			if ($cmd::class === $command) {
				$this->defaultCommand = $command;
			}
		}

		if (!$this->defaultCommand) {
			throw new \Exception('Command is not in your list');
		}
	}
}
