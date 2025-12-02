<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

readonly class NamespaceObject
{
	public function __construct(
		private string $namespace,
		// @var ClassObject[] $classes
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
