<?php

namespace Sakoo\Framework\Core\Container;

use Psr\Container\ContainerInterface;
use Sakoo\Framework\Core\Container\Exceptions\ContainerClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ContainerClassNotInstantiableException;
use Sakoo\Framework\Core\Container\Exceptions\ContainerNotFoundException;
use Sakoo\Framework\Core\Container\Parameter\ParameterSet;
use Sakoo\Framework\Core\Set\Set;

class Container implements ContainerInterface
{
	private Set $singletons;
	private Set $instances;
	private Set $bindings;

	public function __construct()
	{
		$this->singletons = set();
		$this->instances = set();
		$this->bindings = set();
	}

	public function get(string $id)
	{
		throwUnless($this->has($id), new ContainerNotFoundException());
		return $this->resolve($id);
	}

	public function has(string $id): bool
	{
		return $this->singletons->exists($id) || $this->bindings->exists($id);
	}

	public function bind(string $interface, $factory): void
	{
		$this->bindings->{$interface} = $factory;
	}

	public function singleton(string $interface, $factory): void
	{
		$this->singletons->{$interface} = $factory;
	}

	public function resolve(string $interface): object
	{
		if ($this->singletons->exists($interface)) {
			return $this->resolveFromSingletons($interface);
		}

		if ($this->bindings->exists($interface)) {
			return $this->resolveFromBindings($interface);
		}

		return $this->new($interface);
	}

	public function new(string $interface): object
	{
		throwUnless(class_exists($interface), new ContainerClassNotFoundException());

		$reflector = new \ReflectionClass($interface);

		throwUnless($reflector->isInstantiable(), new ContainerClassNotInstantiableException());

		$constructor = $reflector->getConstructor();
		$params = ParameterSet::resolveFromConstructor($this, $constructor);
		return $reflector->newInstanceArgs($params);
	}

	private function resolveFromBindings(string $interface): object
	{
		return $this->handleResolution($this->bindings->{$interface});
	}

	private function resolveFromSingletons(string $interface): object
	{
		if (!$this->instances->exists($interface)) {
			$this->instances->{$interface} = $this->handleResolution($this->singletons->{$interface});
		}
		return $this->instances->{$interface};
	}

	private function handleResolution($factory): object
	{
		if (is_callable($factory)) {
			return call_user_func($factory);
		}

		return $this->new($factory);
	}
}
