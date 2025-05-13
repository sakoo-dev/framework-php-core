<?php

declare(strict_types=1);

use Sakoo\Framework\Core\Command\DevCommand;
use Sakoo\Framework\Core\Command\DocGenCommand;
use Sakoo\Framework\Core\Command\Watcher\WatchCommand;
use Sakoo\Framework\Core\Command\ZenCommand;
use Sakoo\Framework\Core\Console\Application;
use Sakoo\Framework\Core\Console\Command;

/** @var Command[] $commands */
$commands = [
	resolve(ZenCommand::class),
	resolve(WatchCommand::class),
	resolve(DocGenCommand::class),
	resolve(DevCommand::class),
];

/** @var Application $application */
$application = resolve(Application::class);
$application->addCommands($commands);
$application->setDefaultCommand(ZenCommand::class);

return $application;
