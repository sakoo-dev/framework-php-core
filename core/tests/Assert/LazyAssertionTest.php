<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Assert;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Assert\Assert;
use Sakoo\Framework\Core\Assert\Exception\InvalidArgumentException;
use Sakoo\Framework\Core\Assert\Exception\LazyAssertionException;
use Sakoo\Framework\Core\Assert\LazyAssertion;
use Sakoo\Framework\Core\Tests\TestCase;

final class LazyAssertionTest extends TestCase
{
	#[Test]
	public function assert_lazy_is_instance_of_lazy_assertion(): void
	{
		$this->assertInstanceOf(LazyAssertion::class, Assert::lazy());
		$this->assertInstanceOf(LazyAssertion::class, Assert::lazy()->bool(true));
	}

	#[Test]
	public function lazy_assertion_makes_a_chain(): void
	{
		$this->expectException(LazyAssertionException::class);

		Assert::lazy()
			->numeric(false)
			->greater(3, 8)
			->lower(7, 2)
			->validate();

		$exceptions = $this->getExpectedException()->getExceptions();
		$this->assertCount(3, $exceptions);

		$messages = array_map(fn ($item) => $item->getMessage(), $exceptions);
		$this->assertEquals([
			'Given value false is not numeric',
			'Given value 3 is not greater than 8',
			'Given value 7 is not lower than 2',
		], $messages);
	}

	#[Test]
	public function lazy_assertion_can_use_assertion_chain(): void
	{
		$this->expectException(LazyAssertionException::class);
		$this->expectExceptionMessage(implode("\n", [
			'The following assertions failed:',
			"1) Variable One: It's not numeric",
			"2) Variable One: It's lower",
			'3) Variable Two: Given value 5 is not boolean',
			'4) Variable Two: Given value 5 is not false',
		]));

		Assert::lazy()
			->that(true, 'Variable One')->numeric("It's not numeric")->greater(4, "It's lower")
			->that(5, 'Variable Two')->bool()->false()
			->validate();

		$exceptions = $this->getExpectedException()->getExceptions();

		$this->assertCount(4, $exceptions);

		$messages = [
			"It's not numeric",
			"It's lower",
			'Given value 5 is not boolean',
			'Given value 5 is not false',
		];

		foreach ($exceptions as $exception) {
			$this->assertInstanceOf(InvalidArgumentException::class, $exception);
			$this->assertEquals(array_pop($messages), $exception->getMessage());
		}
	}
}
