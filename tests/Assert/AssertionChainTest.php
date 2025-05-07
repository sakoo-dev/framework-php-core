<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Assert;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Assert\Assert;
use Sakoo\Framework\Core\Assert\AssertionChain;
use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\Tests\TestCase;

final class AssertionChainTest extends TestCase
{
	#[Test]
	public function assert_that_is_instance_of_assertion_chain(): void
	{
		$this->assertInstanceOf(AssertionChain::class, Assert::that('Something'));
		$this->assertInstanceOf(AssertionChain::class, Assert::that(true)->bool());
	}

	#[Test]
	public function assert_that_makes_a_chain(): void
	{
		$this->expectException(InvalidArgumentException::class);

		Assert::that('Something')
			->numeric()
			->greater(3)
			->lower(7);

		$exceptions = $this->getExpectedException()->getExceptions();
		$this->assertCount(1, $exceptions);
		$this->assertEquals('Given value false is not numeric', $exceptions[0]->getMessage());
	}
}
