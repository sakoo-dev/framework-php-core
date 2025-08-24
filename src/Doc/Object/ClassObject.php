<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

use Sakoo\Framework\Core\Doc\Attributes\DontDocument;
use Sakoo\Framework\Core\Exception\Exception;

readonly class ClassObject
{
	public function __construct(private \ReflectionClass $class) {}

	public function getMethods(): array
	{
		$data = [];
		$methods = $this->class->getMethods(\ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED);

		foreach ($methods as $method) {
			$method = new MethodObject($method);

			if ($method->isFrameworkFunction()) {
				$data[] = $method;
			}
		}

		return $data;
	}

	public function getNamespace(): string
	{
		return $this->class->getNamespaceName();
	}

	public function isIllegal(): bool
	{
		$dontDocument = !empty($this->class->getAttributes(DontDocument::class));

		return $dontDocument || $this->class->isTrait() || $this->class->isAbstract() || $this->class->isInterface() || !$this->class->isInstantiable();
	}

	public function isException(): bool
	{
		return $this->class->isSubclassOf(Exception::class);
	}

	public function getName(): string
	{
		return $this->class->getShortName();
	}
}
