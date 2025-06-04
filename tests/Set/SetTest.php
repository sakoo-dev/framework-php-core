<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Set;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Set\Exceptions\GenericMismatchException;
use Sakoo\Framework\Core\Set\Set;
use Sakoo\Framework\Core\Tests\TestCase;

final class SetTest extends TestCase
{
	private Set $set;

	protected function setUp(): void
	{
		parent::setUp();

		$this->set = set([
			'key' => 'value',
			'foo' => 'dev',
		]);
	}

	#[Test]
	public function it_can_get_using_property(): void
	{
		$this->assertEquals('value', $this->set->key);
		$this->assertEquals('dev', $this->set->foo);

		$this->assertNull($this->set->else);
	}

	#[Test]
	public function it_can_set_using_property(): void
	{
		$this->set->key = 'Key Value';
		$this->assertEquals('Key Value', $this->set->key);

		$this->set->new = 'New Value';
		$this->assertEquals('New Value', $this->set->new);
	}

	#[Test]
	public function it_can_return_key_exists(): void
	{
		$this->assertTrue($this->set->exists('key'));

		$this->assertFalse($this->set->exists('thing'));
	}

	#[Test]
	public function it_can_return_set_count(): void
	{
		$this->assertEquals(2, $this->set->count());

		$this->assertEquals(0, set()->count());
	}

	#[Test]
	public function it_can_get_using_get_method(): void
	{
		$this->assertEquals('value', $this->set->get('key'));
		$this->assertEquals('dev', $this->set->get('foo'));

		$this->assertNull($this->set->get('else'));
	}

	#[Test]
	public function it_can_get_by_index_using_get_method(): void
	{
		$this->assertEquals('value', $this->set->get(0));
		$this->assertEquals('dev', $this->set->get(1));

		$this->assertNull($this->set->get(1000));
	}

	#[Test]
	public function it_can_return_default_value_if_key_not_found(): void
	{
		$this->assertEquals('value', $this->set->get('key', 'Default'));

		$this->assertEquals('Default', $this->set->get('empty', 'Default'));
	}

	#[Test]
	public function iteration_works_properly(): void
	{
		$this->set->each(fn ($value, $key) => $this->assertEquals($value, $this->set->get($key)));
	}

	#[Test]
	public function it_can_map_items(): void
	{
		$nums = set([1, 2, 3, 4])->map(fn ($item) => $item * 10)->toArray();
		$this->assertEquals([10, 20, 30, 40], $nums);
	}

	#[Test]
	public function it_can_filter_items(): void
	{
		$nums = set([1, 2, 3, 4])->filter(fn ($item) => 0 === $item % 2)->toArray();
		$this->assertEqualsCanonicalizing([2, 4], $nums);
	}

	#[Test]
	public function it_can_pluck_multi_dimensional_sets(): void
	{
		$phones = set([
			[
				'Brand' => 'Apple',
				'Model' => [
					'Name' => 'iPhone',
				],
			],
			[
				'Brand' => 'Samsung',
				'Model' => [
					'Name' => 'Galaxy',
				],
			],
		]);

		$this->assertEquals(['Apple', 'Samsung'], $phones->pluck('Brand')->toArray());
		$this->assertEquals(['iPhone', 'Galaxy'], $phones->pluck('Model.Name')->toArray());
		$this->assertEquals([], $phones->pluck('Something')->toArray());
	}

	#[Test]
	public function it_can_push_item(): void
	{
		$this->set->add('Hello', 'World');
		$this->assertEquals('World', $this->set->get('Hello'));

		$nums = set([1, 2, 3, 4])->add(5);
		$this->assertEquals([1, 2, 3, 4, 5], $nums->toArray());
	}

	#[Test]
	public function it_can_remove_item(): void
	{
		$this->set->remove('Hello');
		$this->assertNull($this->set->get('Hello'));

		$this->set->remove('else');
		$this->assertNull($this->set->get('else'));

		$nums = set([1, 2, 3, 4])->remove(2);
		$this->assertEquals([1, 2, 4], array_values($nums->toArray()));

		$items = set(['key1' => 'value1', 'key2' => 'value2'])->remove('key1');
		$this->assertEquals(['key2' => 'value2'], $items->toArray());
	}

	#[Test]
	public function it_can_export_set_to_array(): void
	{
		$array = ['foo' => 'bar', 'dev' => 'baz'];
		$set = set($array);

		$this->assertSame($array, $set->toArray());
	}

	#[Test]
	public function it_is_an_traversable(): void
	{
		foreach ($this->set as $key => $value) {
			$this->assertEquals($value, $this->set->get($key));
		}
	}

	#[Test]
	public function it_throws_error_on_add_mismatch_type(): void
	{
		$this->expectException(GenericMismatchException::class);
		$this->set->add('key', 123);
	}

	#[Test]
	public function it_throws_error_on_create_mismatch_type(): void
	{
		$this->expectException(GenericMismatchException::class);
		set([1, 'Hello']);
	}
}
