<?php

namespace Core\Testing\Traits;

use Core\Console\Assistant;
use Core\Console\Commands\ZenCommand;
use Symfony\Component\Console\Tester\ApplicationTester;

trait AssistantTester
{
	public function getAssistantApplication($input = [], $options = []): ApplicationTester
	{
		$application = $this->getAssistantApp()->console;
		$application->setAutoExit(false);
		$appTester = new ApplicationTester($application);
		$appTester->run($input, $options);
		return $appTester;
	}

	private function getAssistantApp(): Assistant
	{
		/** @var Assistant $assitant */
		$assistant = resolve(Assistant::class);
		$assistant->console->setDefaultCommand(ZenCommand::getDefaultName());

		return $assistant;
	}
}
