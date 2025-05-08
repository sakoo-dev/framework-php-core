<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\PHPStan\Bug;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class IgnorePureFunctionOutputRule implements Rule
{
	private const PURE_FUNCTIONS = [
		'strlen', 'count', 'array_keys', 'array_values',
		'trim', 'substr', 'explode', 'implode', 'strtolower',
		'strtoupper', 'str_replace', 'json_encode', 'json_decode',
		'array_map', 'array_filter', 'in_array',
	];

	public function getNodeType(): string
	{
		return FuncCall::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		if (!$node instanceof FuncCall || !$node->name instanceof Node\Name) {
			return [];
		}

		$functionName = strtolower((string) $node->name);

		if (in_array($functionName, self::PURE_FUNCTIONS, true)) {
			if ($node->getAttribute('parent') instanceof Node\Stmt\Expression) {
				$message = "The return value of '{$functionName}' should not be ignored as it has no side effects.";

				return [RuleErrorBuilder::message($message)->build()];
			}
		}

		return [];
	}
}
