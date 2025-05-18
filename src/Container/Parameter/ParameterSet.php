<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Parameter;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotInstantiableException;

readonly class ParameterSet
{
	public function __construct(private Container $container) {}

	/**
	 * @param array<\ReflectionParameter> $parameters
	 *
	 * @return list<mixed>
	 *
	 * @throws \ReflectionException
	 * @throws ClassNotFoundException
	 * @throws ClassNotInstantiableException
	 * @throws \Throwable
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
