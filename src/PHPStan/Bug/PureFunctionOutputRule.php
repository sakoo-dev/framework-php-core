<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\PHPStan\Bug;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\Expression;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use Sakoo\Framework\Core\Doc\Attributes\DontDocument;

/**
 * @implements Rule<Expression>
 */
#[DontDocument]
class PureFunctionOutputRule implements Rule
{
	private const PURE_FUNCTIONS = [
		'strlen', 'count', 'array_keys', 'array_values',
		'trim', 'substr', 'explode', 'implode', 'strtolower',
		'strtoupper', 'str_replace', 'json_encode', 'json_decode',
		'array_map', 'array_filter', 'in_array',
	];

	final public const string RULE_SIGNATURE = 'sakoo.bug.pureFunctionOutput';

	public function getNodeType(): string
	{
		return Expression::class;
	}

	public function processNode(Node $node, Scope $scope): array
	{
		if (!$node->expr instanceof FuncCall) {
			return [];
		}

		$funcCall = $node->expr;

		if (!$funcCall->name instanceof Node\Name) {
			return [];
		}

		$functionName = strtolower((string) $funcCall->name);

		if (in_array($functionName, self::PURE_FUNCTIONS, true)) {
			$message = "The return value of '{$functionName}' should not be ignored as it has no side effects.";

			return [RuleErrorBuilder::message($message)->identifier(self::RULE_SIGNATURE)->build()];
		}

		return [];
	}
}
