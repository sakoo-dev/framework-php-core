<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Container\Stubs;

final class ComplexTestClass implements ComplexTestInterface
{
	public function __construct(TestInterface $input) {}
}
