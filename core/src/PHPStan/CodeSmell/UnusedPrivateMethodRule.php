<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\PHPStan\CodeSmell;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PHPStan\Analyser\Scope;
use PHPStan\Node\InClassNode;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use Sakoo\Framework\Core\Doc\Attributes\DontDocument;

/**
 * @implements Rule<InClassNode>
 */
#[DontDocument]
class UnusedPrivateMethodRule implements Rule
{
	final public const string RULE_SIGNATURE = 'sakoo.codeSmell.unusedPrivateMethod';

	public function getNodeType(): string
	{
		return InClassNode::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		/** @var InClassNode $node */
		$class = $node->getOriginalNode();
		$className = $node->getClassReflection()->getName();

		$privateMethods = [];
		$usedMethodNames = [];

		foreach ($class->getMethods() as $method) {
			$methodName = $method->name->toString();

			if ($method->isPrivate() && !$method->isMagic()) {
				$privateMethods[$methodName] = $method;
			}

			$usedMethodNames = array_merge($usedMethodNames, $this->collectCalledMethodNames($method));
		}

		$usedMethodNames = array_unique($usedMethodNames);
		$errors = [];

		foreach ($privateMethods as $name => $method) {
			if (!in_array($name, $usedMethodNames, true)) {
				$message = "Unused private method '{$name}' in class '{$className}' should be removed.";
				$errors[] = RuleErrorBuilder::message($message)->line($method->getLine())->identifier(self::RULE_SIGNATURE)->build();
			}
		}

		return $errors;
	}

	/**
	 * @return array<string>
	 */
	private function collectCalledMethodNames(Node $node): array
	{
		$called = [];

		if ($node instanceof MethodCall || $node instanceof StaticCall) {
			if ($node->name instanceof Identifier) {
				$called[] = $node->name->toString();
			}
		}

		foreach ($node->getSubNodeNames() as $name) {
			$child = $node->{$name};

			if (is_array($child)) {
				foreach ($child as $c) {
					if ($c instanceof Node) {
						$called = array_merge($called, $this->collectCalledMethodNames($c));
					}
				}
			} elseif ($child instanceof Node) {
				$called = array_merge($called, $this->collectCalledMethodNames($child));
			}
		}

		return $called;
	}
}
