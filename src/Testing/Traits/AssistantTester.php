<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing\Traits;

use Sakoo\Framework\Core\Console\Assistant;
use Sakoo\Framework\Core\Path\Path;
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

	protected function getAssistantApp(): Assistant
	{
		return require Path::getCoreDir() . '/Console/Bootstrap.php';
	}
}
