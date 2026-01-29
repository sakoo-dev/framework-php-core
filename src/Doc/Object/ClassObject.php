<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

use Sakoo\Framework\Core\Doc\Attributes\DontDocument;
use Sakoo\Framework\Core\Exception\Exception;
use Sakoo\Framework\Core\Regex\Regex;

readonly class ClassObject
{
	/**
	 * @phpstan-ignore missingType.generics
	 */
	public function __construct(private \ReflectionClass $class) {}

	/**
	 * @return MethodObject[]
	 */
	public function getMethods(): array
	{
		$data = [];
		$methods = $this->class->getMethods(\ReflectionMethod::IS_PUBLIC | \ReflectionMethod::IS_PROTECTED);

		foreach ($methods as $method) {
			$method = new MethodObject($this, $method);

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

		return $dontDocument || $this->class->isTrait() || $this->class->isAbstract() || $this->class->isInterface();
	}

	public function isInstantiable(): bool
	{
		return $this->class->isInstantiable();
	}

	public function isException(): bool
	{
		return $this->class->isSubclassOf(Exception::class);
	}

	public function getName(): string
	{
		return $this->class->getShortName();
	}

	/**
	 * @return string[]
	 */
	public function getPhpDocs(): array
	{
		$phpDoc = $this->class->getDocComment();

		if (!$phpDoc) {
			return [];
		}

		$match = (new Regex())
			->startsWith('/**')
			->add('([\s\S]+)')
			->endsWith('*/')
			->match($phpDoc);

		$lines = explode("\n", $match ? $match[1] : '');

		$result = [];

		foreach ($lines as $line) {
			$result[] = trim($line, "/* \t\r\n");
		}

		return $result;
	}

	/**
	 * @return VirtualMethodObject[]
	 */
	public function getVirtualMethods(): array
	{
		$phpDocs = $this->getPhpDocs();

		if (!$phpDocs) {
			return [];
		}

		$result = [];

		foreach ($phpDocs as $line) {
			if (str_starts_with($line, '@method ')) {
				try {
					$result[] = new VirtualMethodObject($this, $line);
				} catch (InvalidVirtualMethodDefinitionException $e) {
					continue;
				}
			}
		}

		return $result;
	}
}
