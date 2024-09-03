<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Reflection;

use Sakoo\Framework\Core\Exception\Exception;

trait ReflectionClass
{
	private function getClassMethods(\ReflectionClass $reflection): array
	{
		$data['namespace'] = $reflection->getNamespaceName();
		$data['class'] = $reflection->getShortName();
		$data['methods'] = [];
		$data['extra'] = [
			'is_exception' => $reflection->isSubclassOf(Exception::class),
		];

		$methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED);

		foreach ($methods as $method) {
			if ($this->isFrameworkFunction($method)) {
				$data['methods'][] = $this->getMethodDetails($method);
			}
		}

		return $data;
	}

	private function getNamespaceFromPath(string $path): string
	{
		$path = str_replace('.php', '', $path);
		$path = str_replace(getcwd() . '/src', 'Sakoo\Framework\Core', $path);

		return str_replace('/', '\\', $path);
	}
}
