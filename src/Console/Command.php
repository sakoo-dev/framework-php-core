<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

abstract class Command
{
	final public const int SUCCESS = 0;
	final public const int ERROR = 1;

	private string $defaultName = '';
	private string $description = '';

	public function __construct()
	{
		$reflection = new \ReflectionClass(static::class);
		$attr = $reflection->getAttributes(AsCommand::class)[0] ?? null;

		if ($attr) {
			$attr = $attr->newInstance();
			$this->defaultName = $attr->commandName;
			$this->description = $attr->description;
		}
	}

	abstract public function run(Input $input, Output $output): int;

	public function switches(Input $input, Output $output): array
	{
		return [];
	}

	public function getDefaultName(): string
	{
		return $this->defaultName;
	}

	public function getDescription(): string
	{
		return $this->description;
	}
}
