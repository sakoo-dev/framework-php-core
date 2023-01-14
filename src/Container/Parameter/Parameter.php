<?php

namespace Sakoo\Framework\Core\Container\Parameter;

use Sakoo\Framework\Core\Container\Container;

class Parameter
{
	private function __construct()
	{
	}

	public static function resolve(Container $container, \ReflectionParameter $parameter): mixed
	{
		$dependency = $parameter->getType();

		if (static::canResolveType($dependency)) {
			return $container->resolve("$dependency");
		}

		if ($parameter->isDefaultValueAvailable()) {
			return $parameter->getDefaultValue();
		}

		return static::generateDefaultValue($dependency);
	}

	private static function generateDefaultValue(?\ReflectionType $type): mixed
	{
		$default = null;

		if (is_null($type)) {
			return $default;
		}

		if ($type->allowsNull()) {
			$type = substr("$type", 1, strlen("$type") - 1);
		}

		settype($default, $type);

		return $default;
	}

	private static function canResolveType(?\ReflectionType $type): bool
	{
		return !is_null($type) && !$type->isBuiltin();
	}
}
