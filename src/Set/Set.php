<?php

namespace Sakoo\Framework\Core\Set;

class Set implements Iteratable
{
	use SetAccess;

	protected array $items = [];

	private function __construct()
	{
	}

	public static function make(array $array = []): static
	{
		$object = new static();
		$object->items = $array;
		return $object;
	}

	public function __get(string $name): mixed
	{
		return $this->get($name);
	}

	public function __set(string $name, $value): void
	{
		$this->items[$name] = $value;
	}

	public function exists($name): bool
	{
		return isset($this->items[$name]);
	}

	public function count(): int
	{
		return count($this->items);
	}

	public function each($callback): void
	{
		array_walk($this->items, $callback);
	}

	public function map($callback): static
	{
		return static::make(array_map($callback, $this->items));
	}

	public function pluck($key): static
	{
		$nestedKeys = explode('.', $key);

		$result = $this->items;

		foreach ($nestedKeys as $column) {
			$result = array_column($result, $column);
		}

		return set($result);
	}

	public function add($key, $value = null): static
	{
		if (is_null($value)) {
			$this->items[] = $key;
			return $this;
		}

		$this->items[$key] = $value;
		return $this;
	}

	public function remove($key): static
	{
		if (is_int($key)) {
			unset($this->items[array_keys($this->items)[$key]]);
			return $this;
		}

		if ($this->exists($key)) {
			unset($this->items[$key]);
		}
		return $this;
	}

	public function get($key = null, $default = null): mixed
	{
		if (is_null($key)) {
			return $this->items;
		}

		if (is_int($key)) {
			$indexValue = current(array_slice($this->items, $key, 1));
			return $indexValue ?: null;
		}

		return isset($this->items[$key]) ? $this->items[$key] : $default;
	}

	public function toArray(): array
	{
		return $this->items;
	}

	public function getIterator(): \ArrayIterator
	{
		return new \ArrayIterator($this->items);
	}
}
