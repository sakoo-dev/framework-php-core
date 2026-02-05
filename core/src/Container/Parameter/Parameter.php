<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Parameter;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotInstantiableException;

readonly class Parameter
{
	public function __construct(private Container $container) {}

	/**
	 * @throws \Throwable
	 * @throws \ReflectionException
	 * @throws ClassNotInstantiableException
	 * @throws ClassNotFoundException
	 */
	public function resolve(\ReflectionParameter $parameter): mixed
	{
		$dependency = $parameter->getType();

		if ($this->canResolveType($dependency)) {
			return $this->container->resolve("$dependency");
		}

		if ($parameter->isDefaultValueAvailable()) {
			return $parameter->getDefaultValue();
		}

		return $this->generateDefaultValue($dependency);
	}

	private function generateDefaultValue(?\ReflectionType $type): mixed
	{
		if (is_null($type)) {
			return null;
		}

		if ($type instanceof \ReflectionNamedType) {
			return match ($type->getName()) {
				'string' => '',
				'int', 'integer' => 0,
				'float', 'double' => 0.0,
				'bool', 'boolean' => false,
				'array' => [],
				'object', 'stdClass' => new \stdClass(),
				'callable', 'closure' => function () {},
				default => null,
			};
		}

		if ($type instanceof \ReflectionUnionType || $type instanceof \ReflectionIntersectionType) {
			$types = $type->getTypes();

			foreach ($types as $subType) {
				$value = $this->generateDefaultValue($subType);

				if (null !== $value) {
					return $value;
				}
			}
		}

		return null;
	}

	private function canResolveType(?\ReflectionType $type): bool
	{
		if (is_null($type)) {
			return false;
		}

		if ($type instanceof \ReflectionNamedType && $type->isBuiltin()) {
			return false;
		}

		return true;
	}
}
