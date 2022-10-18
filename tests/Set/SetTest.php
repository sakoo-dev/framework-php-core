<?php

namespace Sakoo\Framework\Core\Tests\Set;

use Sakoo\Framework\Core\Set\Set;
use Sakoo\Framework\Core\Tests\TestCase;

class SetTest extends TestCase
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

	public function test_it_is_instance_of_set()
	{
		$this->assertInstanceOf(Set::class, $this->set);
	}

	public function test_it_can_get_using_property()
	{
		$this->assertEquals('value', $this->set->key);
		$this->assertEquals('dev', $this->set->foo);

		$this->assertNull($this->set->else);
	}

	public function test_it_can_set_using_property()
	{
		$this->set->key = 'Key Value';
		$this->assertEquals('Key Value', $this->set->key);

		$this->set->new = 'New Value';
		$this->assertEquals('New Value', $this->set->new);
	}

	public function test_it_can_return_key_exists()
	{
		$this->assertTrue($this->set->exists('key'));

		$this->assertFalse($this->set->exists('thing'));
	}

	public function test_it_can_return_set_count()
	{
		$this->assertEquals(2, $this->set->count());

		$this->assertEquals(0, set()->count());
	}

	public function test_it_can_get_array_using_get_method()
	{
		$array = $this->set->get();

		$this->assertTrue(is_array($array));
		$this->assertEquals(2, count($array));
	}

	public function test_it_can_get_using_get_method()
	{
		$this->assertEquals('value', $this->set->get('key'));
		$this->assertEquals('dev', $this->set->get('foo'));

		$this->assertNull($this->set->get('else'));
	}

	public function test_it_can_get_by_index_using_get_method()
	{
		$this->assertEquals('value', $this->set->get(0));
		$this->assertEquals('dev', $this->set->get(1));

		$this->assertNull($this->set->get(1000));
	}

	public function test_it_can_return_default_value_if_key_not_found()
	{
		$this->assertEquals('value', $this->set->get('key', 'Default'));

		$this->assertEquals('Default', $this->set->get('empty', 'Default'));
	}

	public function test_iteration_works_properly()
	{
		$this->set->each(fn ($value, $key) => $this->assertEquals($value, $this->set->get($key)));
	}

	public function test_it_can_map_items()
	{
		$nums = set([1, 2, 3, 4])->map(fn ($item) => $item * 10)->get();
		$this->assertEquals([10, 20, 30, 40], $nums);
	}

	public function test_it_can_pluck_multidimential_sets()
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

	public function test_it_can_push_item()
	{
		$this->set->add('Hello', 'World');
		$this->assertEquals('World', $this->set->get('Hello'));

		$nums = set([1, 2, 3, 4])->add(5);
		$this->assertEquals([1, 2, 3, 4, 5], $nums->get());
	}

	public function test_it_can_remove_item()
	{
		$this->set->remove('Hello');
		$this->assertNull($this->set->get('Hello'));

		$this->set->remove('else');
		$this->assertNull($this->set->get('else'));

		$nums = set([1, 2, 3, 4])->remove(2);
		$this->assertEquals([1, 2, 4], array_values($nums->get()));

		$items = set(['key1' => 'value1', 'key2' => 'value2'])->remove('key1');
		$this->assertEquals(['key2' => 'value2'], $items->get());
	}

	public function test_it_can_export_set_to_array()
	{
		$array = ['foo' => 'bar', 'dev' => 'baz'];
		$set = set($array);

		$this->assertSame($array, $set->toArray());
	}

	public function test_it_is_an_traversable()
	{
		foreach ($this->set as $key => $value) {
			$this->assertEquals($value, $this->set->get($key));
		}

		$this->assertInstanceOf(\Traversable::class, $this->set);
	}
}
