<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\PHPStan\CodeSmell;

use PHPStan\Rules\Rule;
use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\PHPStan\CodeSmell\UnusedPrivateMethodRule;
use Sakoo\Framework\Core\Tests\PHPStan\PHPStanTestCase;

/**
 * @extends RuleTestCase<UnusedPrivateMethodRule>
 */
final class UnusedPrivateMethodRuleTest extends PHPStanTestCase
{
	protected function getRule(): Rule
	{
		return new UnusedPrivateMethodRule();
	}

	#[Test]
	public function detects_unused_private_methods(): void
	{
		$errorMessage = "Unused private method '%s' in class '%s' should be removed.";

		$this->analyse([__DIR__ . '/Stub.php'], [
			[sprintf($errorMessage, 'unusedMethod', 'TestClass'), 6],
			[sprintf($errorMessage, 'anotherUnusedMethod', 'TestClass'), 12],
			[sprintf($errorMessage, 'orphanMethod', 'AnotherClass'), 56],
		]);
	}
}
