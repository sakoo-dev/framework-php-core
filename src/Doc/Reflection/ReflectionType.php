<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Reflection;

trait ReflectionType
{
	private function getReflectionUnionTypeName(\ReflectionUnionType $type): string
	{
		$result = '';

		foreach ($type->getTypes() as $reflectionUnionType) {
			if (!$reflectionUnionType->isBuiltin()) {
				$result .= $this->getShortClassName($reflectionUnionType->getName());
			} else {
				$result .= $reflectionUnionType;
			}
			$result .= '|';
		}

		if (str_ends_with($result, '|')) {
			$result = substr($result, 0, -1);
		}

		return $result;
	}

	private function getTypeName(\ReflectionIntersectionType|\ReflectionNamedType|\ReflectionUnionType $type): string
	{
		$result = '';

		if ($type instanceof \ReflectionUnionType) {
			$result = $this->getReflectionUnionTypeName($type);
		} else {
			if (!$type->isBuiltin()) {
				$result .= $this->getShortClassName($type->getName());
			} else {
				$result .= $type->getName();
			}
		}

		return $result;
	}

	private function getShortClassName(string $fullClassName): string
	{
		$classNameParts = explode('\\', $fullClassName);

		return array_pop($classNameParts);
	}
}
