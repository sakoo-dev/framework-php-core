<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Reflection;

use Sakoo\Framework\Core\Regex\Regex;

trait ReflectionMethod
{
	private function getMethodDetails(\ReflectionMethod $method): array
	{
		return [
			'name' => $method->getName(),
			'parameters' => $this->getMethodParameters($method),
			'returnTypes' => $this->getMethodReturnTypes($method),
			'modifiers' => \Reflection::getModifierNames($method->getModifiers()),
			'phpdoc' => $this->getMethodPhpDocs($method),
		];
	}

	private function getMethodParameters(\ReflectionMethod $method): array
	{
		$parameters = [];

		foreach ($method->getParameters() as $parameter) {
			$parameters[] = [
				'type' => ($type = $parameter->getType()) ? $this->getTypeName($type) : '',
				'name' => $parameter->getName(),
			];
		}

		return $parameters;
	}

	private function getMethodReturnTypes(\ReflectionMethod $method): string
	{
		return ($returnType = $method->getReturnType()) ? $this->getTypeName($returnType) : '';
	}

	private function getMethodPhpDocs(\ReflectionMethod $method): string
	{
		$phpDoc = $method->getDocComment();

		if (!$phpDoc) {
			return '';
		}

		$match = Regex::make()
			->startsWith('/**')
			->add('([\s\S]*)')
			->endsWith('*/')
			->match($phpDoc);

		return $match ? $match[1] : '';
	}

	private function isFrameworkFunction(\ReflectionMethod $method): bool
	{
		return str_starts_with($method->class, 'Sakoo\Framework\Core');
	}
}
