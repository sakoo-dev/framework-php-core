<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container;

use Sakoo\Framework\Core\Container\Exceptions\ClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotInstantiableException;
use Sakoo\Framework\Core\Container\Exceptions\ContainerNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\TypeMismatchException;
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

	public function get(string $id): object
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
		$this->checkMismatchType($interface, $factory);
		$this->bindings->{$interface} = $factory;
	}

	public function singleton(string $interface, $factory): void
	{
		$this->checkMismatchType($interface, $factory);
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

	public function new(string $class): object
	{
		throwUnless(class_exists($class), new ClassNotFoundException());

		$reflector = new \ReflectionClass($class);

		throwUnless($reflector->isInstantiable(), new ClassNotInstantiableException());

		$constructor = $reflector->getConstructor();
		$params = [];

		if (!is_null($constructor)) {
			$parameterSet = new ParameterSet($this);
			$params = $parameterSet->resolve($constructor->getParameters());
		}

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

	private function checkMismatchType(string $interface, $factory): void
	{
		throwIf(interface_exists($interface) && !is_subclass_of($factory, $interface), new TypeMismatchException());
	}
}
