<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

use Sakoo\Framework\Core\Doc\Object\ClassObject;
use Sakoo\Framework\Core\Doc\Object\MethodInterface;
use Sakoo\Framework\Core\Doc\Object\MethodObject;
use Sakoo\Framework\Core\Doc\Object\NamespaceObject;

class DocFormatter extends Formatter
{
	/*
	 * TODO: required functionalities for Documentation Generator:
	 * Throws Label for methods
	 * Supporting Attributes
	 * Supporting Helper functions
	 */

	public function format(array $namespaces): string
	{
		$this->markup->h1('📚 Documentation');

		foreach ($namespaces as $namespace) {
			$this->markup->h2('📦 ' . $namespace->getName());
			$this->parseNamespace($namespace);
		}

		return (string) $this->markup;
	}

	private function parseMethod(MethodInterface $method): void
	{
		$class = $method->getClass();

		$parameters = $method->getDefaultValueTypes();
		$parametersVars = $method->getDefaultValues();

		$modifiers = $method->getModifiers();
		$modifiers = implode(' ', $modifiers) . ($modifiers ? ' ' : '');

		if ($returnTypes = $method->getMethodReturnTypes()) {
			$returnTypes = ': ' . $returnTypes;
		}

		$instancePointer = '$' . lcfirst($class->getName());

		if ($method->isStaticInstantiator()) {
			$this->markup->h4('How to use the Class:');
			$this->markup->code("$instancePointer = " . $class->getName() . '::' . $method->getName() . "($parameters)", 'php');

			return;
		}

		if ($method->isConstructor()) {
			$this->markup->h4('How to use the Class:');
			$this->markup->code("$instancePointer = new " . $class->getName() . "($parameters)", 'php');

			return;
		}

		$this->markup->h5('Contract');
		$this->markup->code("$modifiers" . 'function ' . $method->getName() . "($parameters)$returnTypes", 'php');

		$this->markup->h5('Usage');

		if ($method->isStatic()) {
			$this->markup->code($class->getName() . '::' . $method->getName() . "($parametersVars)", 'php');

			return;
		}

		$this->markup->code("$instancePointer->" . $method->getName() . "($parametersVars)", 'php');
	}

	private function parseClass(ClassObject $class): void
	{
		/** @var MethodInterface[] $methods */
		$methods = array_merge($class->getVirtualMethods(), $class->getMethods());

		foreach ($methods as $method) {
			/** @var MethodObject $method */
			if ($method->shouldNotDocument()) {
				continue;
			}

			$this->markup->hr();

			$this->parseMethod($method);

			foreach ($method->getPhpDocs() as $line) {
				if (empty($line)) {
					continue;
				}

				$this->markup->tiny(htmlspecialchars($line));
			}
		}
	}

	private function parseNamespace(NamespaceObject $namespace): void
	{
		foreach ($namespace->getClasses() as $class) {
			$icon = $class->isException() ? '🟥' : '🟢';
			$this->markup->h3($icon . ' ' . $class->getName());

			$this->parseClass($class);
		}
	}
}
