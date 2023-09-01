<?php

declare(strict_types=1);

use Sakoo\Framework\Core\Console\Assistant;
use Sakoo\Framework\Core\Console\Commands\DocGenCommand;
use Sakoo\Framework\Core\Console\Commands\WatchCommand;
use Sakoo\Framework\Core\Console\Commands\ZenCommand;

$commands = [
	resolve(ZenCommand::class),
	resolve(WatchCommand::class),
	resolve(DocGenCommand::class),
];

/** @var Assistant $assistant */
$assistant = resolve(Assistant::class);
$assistant->console->addCommands($commands);
$assistant->console->setDefaultCommand(ZenCommand::getDefaultName());

return $assistant;
