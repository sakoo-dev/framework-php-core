<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Container;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ContainerNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\TypeMismatchException;
use Sakoo\Framework\Core\Tests\Container\Stubs\AutoWireTestClass;
use Sakoo\Framework\Core\Tests\Container\Stubs\TestClass;
use Sakoo\Framework\Core\Tests\Container\Stubs\TestInterface;
use Sakoo\Framework\Core\Tests\TestCase;

final class ContainerTest extends TestCase
{
	private Container $container;

	protected function setUp(): void
	{
		parent::setUp();
		$this->container = new Container();
	}

	public function objects(): \Generator
	{
		yield 'closure' => [fn () => new TestClass()];
		yield 'class' => [TestClass::class];
	}

	#[DataProvider('objects')]
	#[Test]
	public function container_can_resolve_interface_binding($object): void
	{
		$this->container->bind('class', $object);
		$resolved = $this->container->resolve('class');

		$this->assertInstanceOf(TestClass::class, $resolved);
		$this->assertNotSame($resolved, $this->container->resolve('class'));
	}

	#[DataProvider('objects')]
	#[Test]
	public function container_can_resolve_singleton_binding($object): void
	{
		$this->container->singleton('class', $object);
		$resolved = $this->container->resolve('class');

		$this->assertInstanceOf(TestClass::class, $resolved);
		$this->assertSame($resolved, $this->container->resolve('class'));
	}

	#[Test]
	public function it_instantiate_class_properly(): void
	{
		$object = $this->container->new(TestClass::class);
		$this->assertInstanceOf(TestClass::class, $object);
	}

	#[Test]
	public function it_instantiate_class_with_custom_args(): void
	{
		$testClass = new TestClass();

		/** @var AutoWireTestClass $object */
		$object = $this->container->new(AutoWireTestClass::class, [
			'first' => $testClass,
			'second' => ['k' => 'v'],
			'third' => 'Foo',
			'fourth' => null,
			'fifth' => 123,
		]);

		$this->assertInstanceOf(AutoWireTestClass::class, $object);
		$this->assertSame($testClass, $object->first);
		$this->assertEquals(['k' => 'v'], $object->second);
		$this->assertEquals('Foo', $object->third);
		$this->assertNull($object->fourth);
		$this->assertEquals(123, $object->fifth);
		$this->assertEquals('Default Value', $object->sixth);
	}

	#[Test]
	public function it_resolves_abstractions(): void
	{
		$this->container->bind(TestInterface::class, TestClass::class);
		$resolved = $this->container->resolve(AutoWireTestClass::class);

		$this->assertInstanceOf(TestClass::class, $resolved->first);
		$this->assertNull($resolved->second);
		$this->assertSame('', $resolved->third);
		$this->assertSame('', $resolved->fourth);
		$this->assertSame(0, $resolved->fifth);
		$this->assertSame('Default Value', $resolved->sixth);
	}

	#[Test]
	public function psr_11_the_has_function_works_properly(): void
	{
		$this->assertFalse($this->container->has('binded'));
		$this->container->bind('binded', TestClass::class);
		$this->assertTrue($this->container->has('binded'));

		$this->assertFalse($this->container->has('singletoned'));
		$this->container->singleton('singletoned', TestClass::class);
		$this->assertTrue($this->container->has('singletoned'));
	}

	#[Test]
	public function prs_11_the_get_function_works_properly(): void
	{
		$this->container->bind('something', TestClass::class);
		$this->assertInstanceOf(TestClass::class, $this->container->get('something'));

		$this->expectException(ContainerNotFoundException::class);
		$this->container->get('another');
	}

	#[Test]
	public function clears_data_properly(): void
	{
		$this->container->bind('something', TestClass::class);

		$this->assertTrue($this->container->has('something'));

		$this->container->clear();

		$this->assertFalse($this->container->has('something'));
	}

	#[Test]
	public function it_throws_exception_when_class_not_found_on_new(): void
	{
		$this->expectException(ClassNotFoundException::class);
		$this->container->new('something');
	}

	#[Test]
	public function it_throws_exception_when_class_not_found_on_resolve(): void
	{
		$this->expectException(ClassNotFoundException::class);
		$this->container->resolve('something');
	}

	#[Test]
	public function container_cannot_bind_mismatch_type(): void
	{
		$this->expectException(TypeMismatchException::class);
		$this->container->singleton(TestInterface::class, new \stdClass());
	}

	#[Test]
	public function container_cannot_singleton_mismatch_type(): void
	{
		$this->expectException(TypeMismatchException::class);
		$this->container->bind(TestInterface::class, new \stdClass());
	}
}
