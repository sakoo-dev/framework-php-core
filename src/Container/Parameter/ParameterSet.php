<?php

namespace Sakoo\Framework\Core\Container\Parameter;

use ReflectionMethod;
use Sakoo\Framework\Core\Container\Container;

class ParameterSet
{
	private function __construct()
	{
	}

	public static function resolveFromConstructor(Container $container, ?ReflectionMethod $constructor): array
	{
		if (is_null($constructor)) {
			return [];
		}

		$parameters = $constructor->getParameters();

		$dependencies = [];
		foreach ($parameters as $parameter) {
			$dependencies[] = Parameter::resolve($container, $parameter);
		}

		return $dependencies;
	}
}
