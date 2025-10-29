<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Contracts;

use Psr\Container\ContainerInterface as PsrContainerInterface;

interface ContainerInterface extends PsrContainerInterface, ShouldCache
{
	public function resolve(string $interface): object;

	/** @param mixed[] $params */
	public function new(string $class, array $params = []): object;

	public function bind(string $interface, callable|object|string $factory): void;

	public function singleton(string $interface, callable|object|string $factory): void;

	public function clear(): void;
}
