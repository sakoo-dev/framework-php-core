<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\PHPStan\CodeSmell;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class UnusedPrivateMethodRule implements Rule
{
	private array $definedPrivateMethods = [];
	private array $usedMethods = [];

	public function getNodeType(): string
	{
		return Node::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		$classReflection = $scope->getClassReflection();

		if (!$classReflection) {
			return [];
		}

		$className = $classReflection->getName();

		if ($node instanceof ClassMethod && $node->isPrivate()) {
			$this->definedPrivateMethods[$className][] = $node->name->toString();
		}

		if (($node instanceof MethodCall || $node instanceof StaticCall) && $node->name instanceof Node\Identifier) {
			$this->usedMethods[$className][] = $node->name->toString();
		}

		$errors = [];

		foreach ($this->definedPrivateMethods as $className => $definedMethods) {
			$usedMethods = $this->usedMethods[$className] ?? [];
			$unusedMethods = array_diff($definedMethods, $usedMethods);

			foreach ($unusedMethods as $unusedMethod) {
				$message = "Unused private method '{$unusedMethod}' in class '{$className}' should be removed.";
				$errors[] = RuleErrorBuilder::message($message)
					->identifier('sakoo.codeSmell.unusedPrivateMethod')
					->build();
			}
		}

		return $errors;
	}
}
