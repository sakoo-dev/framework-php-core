<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

#[\Attribute(\Attribute::TARGET_CLASS)]
final class AsCommand
{
	public function __construct(
		public string $commandName,
		public string $description,
	) {}
}
