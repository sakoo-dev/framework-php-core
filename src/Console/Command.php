<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

abstract class Command
{
	private Application $application;

	abstract public function run(Input $input, Output $output): int;

	abstract public static function getName(): string;

	abstract public static function getDescription(): string;

	public function setRunningApplication(Application $app): void
	{
		$this->application = $app;
	}

	public function getApplication(): Application
	{
		return $this->application;
	}
}
