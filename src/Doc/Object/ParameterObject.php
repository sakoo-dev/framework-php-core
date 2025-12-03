<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

readonly class ParameterObject
{
	public function __construct(private \ReflectionParameter $parameter) {}

	public function getName(): string
	{
		return $this->parameter->getName();
	}

	public function getType(): TypeObject
	{
		/** @var null|\ReflectionIntersectionType|\ReflectionNamedType|\ReflectionUnionType $type */
		$type = $this->parameter->getType();

		return new TypeObject($type);
	}
}
