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
		return new TypeObject($this->parameter->getType());
	}
}
