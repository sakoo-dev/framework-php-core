<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

use Sakoo\Framework\Core\Constants;
use Symfony\Component\Console\Application;

class Assistant
{
	public function __construct(public Application $console)
	{
		$console->setName(Constants::FRAMEWORK_NAME);
		$console->setVersion(Constants::FRAMEWORK_VERSION);
	}
}
