<?php

use Sakoo\Framework\Core\Console\Assistant;
use Sakoo\Framework\Core\Console\Commands\WatchCommand;
use Sakoo\Framework\Core\Console\Commands\ZenCommand;

$commands = [
	resolve(ZenCommand::class),
	resolve(WatchCommand::class),
];

/** @var Assistant $assistant */
$assistant = resolve(Assistant::class);
$assistant->console->addCommands($commands);
$assistant->console->setDefaultCommand(ZenCommand::getDefaultName());

return $assistant;
