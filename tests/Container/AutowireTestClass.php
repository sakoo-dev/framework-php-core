<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Container;

final class AutoWireTestClass
{
	public function __construct(
		public TestInterface $first,
		public $second,
		public string $third,
		public ?string $fourth,
		public int $fifth,
		public $sixth = 'Default Value'
	) {}
}
