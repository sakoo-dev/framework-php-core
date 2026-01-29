<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\PHPStan\Bug;

use PHPStan\Rules\Rule;
use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\PHPStan\Bug\PureFunctionOutputRule;
use Sakoo\Framework\Core\Tests\PHPStan\PHPStanTestCase;

/**
 * @extends RuleTestCase<PureFunctionOutputRule>
 */
final class PureFunctionOutputRuleTest extends PHPStanTestCase
{
	protected function getRule(): Rule
	{
		return new PureFunctionOutputRule();
	}

	#[Test]
	public function detects_ignored_pure_function_calls(): void
	{
		$errorMessage = "The return value of '%s' should not be ignored as it has no side effects.";

		$this->analyse([__DIR__ . '/Stub.php'], [
			[sprintf($errorMessage, 'strlen'), 7],
			[sprintf($errorMessage, 'count'), 8],
			[sprintf($errorMessage, 'trim'), 9],
			[sprintf($errorMessage, 'strlen'), 25],
		]);
	}
}
