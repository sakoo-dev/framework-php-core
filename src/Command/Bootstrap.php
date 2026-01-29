<?php

declare(strict_types=1);

use Sakoo\Framework\Core\Command\ContainerCacheCommand;
use Sakoo\Framework\Core\Command\DevCommand;
use Sakoo\Framework\Core\Command\DocGenCommand;
use Sakoo\Framework\Core\Command\McpServerCommand;
use Sakoo\Framework\Core\Command\Watcher\WatchCommand;
use Sakoo\Framework\Core\Command\ZenCommand;
use Sakoo\Framework\Core\Console\Application;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Path\Path;

$docOutputDir = Path::getRootDir() . '/.github/wiki';

/** @var Command[] $commands */
$commands = [
	resolve(ZenCommand::class),
	resolve(WatchCommand::class),
	resolve(DevCommand::class),
	resolve(McpServerCommand::class),
	makeInstance(ContainerCacheCommand::class, [container()]),
	makeInstance(DocGenCommand::class, ["$docOutputDir/Home.md", "$docOutputDir/_Sidebar.md", "$docOutputDir/_Footer.md"]),
];

/** @var Application $application */
$application = resolve(Application::class);
$application->addCommands($commands);
$application->setDefaultCommand(ZenCommand::class);

return $application;
