<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Parameter;

use Sakoo\Framework\Core\Container\Container;

readonly class ParameterSet
{
	public function __construct(private Container $container) {}

	/**
	 * @param array<\ReflectionParameter> $parameters
	 */
	public function resolve(array $parameters): array
	{
		$dependencies = [];
		$parameterEntity = new Parameter($this->container);

		foreach ($parameters as $parameter) {
			$dependencies[] = $parameterEntity->resolve($parameter);
		}

		return $dependencies;
	}
}
