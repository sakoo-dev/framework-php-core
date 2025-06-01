<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\ServiceLoader;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\ServiceLoader\ServiceLoader;
use Sakoo\Framework\Core\Tests\TestCase;

final class ServiceLoaderTest extends TestCase
{
	#[Test]
	public function it_has_valid_signature(): void
	{
		$reflector = new \ReflectionClass(ServiceLoader::class);

		$this->assertTrue($reflector->isAbstract());

		$this->assertTrue($reflector->hasMethod('load'));
		$method = $reflector->getMethod('load');
		$this->assertEquals(Container::class, $method->getParameters()[0]->getType()->getName());
	}
}
