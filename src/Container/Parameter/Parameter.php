<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Parameter;

use Sakoo\Framework\Core\Container\Container;

class Parameter
{
	public function __construct(private Container $container) {}

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
		$default = null;

		if (is_null($type)) {
			return $default;
		}

		if ($type->allowsNull()) {
			$type = substr("$type", 1, strlen("$type") - 1);
		}

		settype($default, "$type");

		return $default;
	}

	private function canResolveType(?\ReflectionType $type): bool
	{
		return !is_null($type) && !$type->isBuiltin();
	}
}
