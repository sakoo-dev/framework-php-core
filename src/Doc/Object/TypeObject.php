<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

readonly class TypeObject
{
	public function __construct(private \ReflectionIntersectionType|\ReflectionNamedType|\ReflectionUnionType|null $type) {}

	public function getName(): ?string
	{
		if (is_null($this->type)) {
			return null;
		}

		if ($this->type instanceof \ReflectionUnionType) {
			return $this->getReflectionUnionTypeName($this->type);
		}

		if ($this->type->isBuiltin()) {
			return $this->type->getName();
		}

		return $this->getShortClassName($this->type->getName());
	}

	public function getReflectionUnionTypeName(\ReflectionUnionType $type): string
	{
		$result = '';

		foreach ($type->getTypes() as $reflectionUnionType) {
			$result .= ($reflectionUnionType->isBuiltin() ? $reflectionUnionType : $this->getShortClassName($reflectionUnionType->getName())) . '|';
		}

		if (str_ends_with($result, '|')) {
			$result = substr($result, 0, -1);
		}

		return $result;
	}

	private function getShortClassName(string $fullClassName): string
	{
		$classNameParts = explode('\\', $fullClassName);

		return array_pop($classNameParts);
	}
}
