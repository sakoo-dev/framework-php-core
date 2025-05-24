<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

use Sakoo\Framework\Core\Doc\Object\MethodObject;

class DocFormatter extends Formatter
{
	public function format(array $data): string
	{
		/*
		 * PHP Doc Formatting
		 * Support Fake method Creation with @method
		 * Support Static Creator instead of Constructor
		 * Space at the beginning of the function if type hint is not present
		 * -------------------------------------------
		 * BDD -> Test -> LLM -> Code -> PHPStan, Csfixer
		 * JSON Config ⇒ Admin Panel CRUD
		 */

		$this->markup->h1('📚 Documentation');

		foreach ($data as $namespace => $classes) {
			$this->markup->h2('📦 ' . $namespace);

			foreach ($classes as $class) {
				$icon = $class->isException() ? '🟥' : '🟢';
				$this->markup->h3($icon . ' ' . $class->getName());

				foreach ($class->getMethods() as $method) {
					/** @var MethodObject $method */
					if ($method->isPrivate() || $method->shouldNotDocument()) {
						continue;
					}

					$this->markup->hr();

					$parameters = $method->getDefaultValueTypes();
					$parametersVars = $method->getDefaultValues();

					if ($modifiers = $method->getModifiers()) {
						$modifiers = implode(' ', $method->getModifiers()) . ' ';
					}

					if ($returnTypes = $method->getMethodReturnTypes()) {
						$returnTypes = ': ' . $returnTypes;
					}

					$instancePointer = '$' . lcfirst($class->getName());

					if ($method->isConstructor()) {
						$this->markup->h4('How to use the Class:');
						$this->markup->code("$instancePointer = new " . $class->getName() . "($parameters)", 'php');
					} elseif ($method->isMagicMethod()) {
						$this->markup->h5('Magic Method');
						$this->markup->code("$modifiers" . 'function ' . $method->getName() . "($parameters)$returnTypes", 'php');
					} else {
						$this->markup->h5('Contract');
						$this->markup->code("$modifiers" . 'function ' . $method->getName() . "($parameters)$returnTypes", 'php');

						$this->markup->h5('Usage');

						if ($method->isStatic()) {
							$this->markup->code($class->getName() . '::' . $method->getName() . "($parametersVars)", 'php');
						} else {
							$this->markup->code("$instancePointer->" . $method->getName() . "($parametersVars)", 'php');
						}
					}

					$this->markup->tiny($method->getPhpDocs() ?: 'PHP Docs will appear here for describing methods functionality and their signature');
					$this->markup->fbr();
					$this->markup->br();
				}
			}
		}

		return (string) $this->markup;
	}
}
