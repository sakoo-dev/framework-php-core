<?php

declare(strict_types=1);

use Sakoo\Framework\Core\Command\Assistant;
use Sakoo\Framework\Core\Command\DevCommand;
use Sakoo\Framework\Core\Command\DocGenCommand;
use Sakoo\Framework\Core\Command\HelpCommand;
use Sakoo\Framework\Core\Command\Watcher\WatchCommand;
use Sakoo\Framework\Core\Command\ZenCommand;

$commands = [
	resolve(ZenCommand::class),
	resolve(WatchCommand::class),
	resolve(DocGenCommand::class),
	resolve(HelpCommand::class),
	resolve(DevCommand::class),
];

/** @var Assistant $assistant */
$assistant = resolve(Assistant::class);
$assistant->console->addCommands($commands);
$assistant->console->setDefaultCommand(ZenCommand::class);

return $assistant;
