<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

readonly class NamespaceObject
{
	/**
	 * @param ClassObject[] $classes
	 */
	public function __construct(
		private string $namespace,
		private array $classes,
	) {}

	/**
	 * @return ClassObject[]
	 */
	public function getClasses(): array
	{
		return $this->classes;
	}

	public function getName(): string
	{
		return $this->namespace;
	}
}
