<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Container;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ContainerNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\TypeMismatchException;
use Sakoo\Framework\Core\Tests\TestCase;

final class ContainerTest extends TestCase
{
	private Container $container;

	protected function setUp(): void
	{
		parent::setUp();
		$this->container = new Container();
	}

	public function objects()
	{
		yield 'closure' => [fn () => new TestClass()];
		yield 'class' => [TestClass::class];
	}

	/** @dataProvider objects */
	public function test_container_can_resolve_interface_binding($object)
	{
		$this->container->bind('class', $object);
		$resolved = $this->container->resolve('class');

		$this->assertInstanceOf(TestClass::class, $resolved);
		$this->assertNotSame($resolved, $this->container->resolve('class'));
	}

	/** @dataProvider objects */
	public function test_container_can_resolve_singleton_binding($object)
	{
		$this->container->singleton('class', $object);
		$resolved = $this->container->resolve('class');

		$this->assertInstanceOf(TestClass::class, $resolved);
		$this->assertSame($resolved, $this->container->resolve('class'));
	}

	public function test_it_instantiate_class_properly()
	{
		$object = $this->container->new(TestClass::class);
		$this->assertInstanceOf(TestClass::class, $object);
	}

	public function test_it_resolves_abstractions()
	{
		$this->container->bind(TestInterface::class, TestClass::class);
		$resolved = $this->container->resolve(AutowireTestClass::class);

		$this->assertInstanceOf(TestClass::class, $resolved->first);
		$this->assertNull($resolved->second);
		$this->assertSame('', $resolved->third);
		$this->assertSame('', $resolved->fourth);
		$this->assertSame(0, $resolved->fifth);
		$this->assertSame('Default Value', $resolved->sixth);
	}

	public function test_psr_11_the_has_function_works_properly()
	{
		$this->assertFalse($this->container->has('binded'));
		$this->container->bind('binded', TestClass::class);
		$this->assertTrue($this->container->has('binded'));

		$this->assertFalse($this->container->has('singletoned'));
		$this->container->singleton('singletoned', TestClass::class);
		$this->assertTrue($this->container->has('singletoned'));
	}

	public function test_prs_11_the_get_function_works_properly()
	{
		$this->container->bind('something', TestClass::class);
		$this->assertInstanceOf(TestClass::class, $this->container->get('something'));

		$this->expectException(ContainerNotFoundException::class);
		$this->container->get('another');
	}

	public function test_it_throws_exception_when_class_not_found_on_new()
	{
		$this->expectException(ClassNotFoundException::class);
		$this->container->new('something');
	}

	public function test_it_throws_exception_when_class_not_found_on_resolve()
	{
		$this->expectException(ClassNotFoundException::class);
		$this->container->resolve('something');
	}

	public function test_container_cannot_bind_mismatch_type()
	{
		$this->expectException(TypeMismatchException::class);
		$this->container->singleton(TestInterface::class, new \stdClass());
	}

	public function test_container_cannot_singleton_mismatch_type()
	{
		$this->expectException(TypeMismatchException::class);
		$this->container->bind(TestInterface::class, new \stdClass());
	}
}
