<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container;

use Psr\Container\ContainerInterface as PsrContainerInterface;

interface ContainerInterface extends PsrContainerInterface
{
	public function resolve(string $interface): object;

	public function new(string $class): object;

	public function bind(string $interface, $factory): void;

	public function singleton(string $interface, $factory): void;
}
