<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\Application;
use Sakoo\Framework\Core\Constants;

class Assistant
{
	public function __construct(public Application $console)
	{
		$console->setName(Constants::FRAMEWORK_NAME);
		$console->setVersion(Constants::FRAMEWORK_VERSION);
	}
}
