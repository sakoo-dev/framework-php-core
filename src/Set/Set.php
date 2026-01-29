<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Set;

use Sakoo\Framework\Core\Assert\Assert;
use Sakoo\Framework\Core\Set\Exceptions\GenericMismatchException;
use Sakoo\Framework\Core\Set\Strategy\Searcher;
use Sakoo\Framework\Core\Set\Strategy\Sorter;

/**
 * @template T
 *
 * @implements IterableInterface<T>
 */
class Set implements IterableInterface
{
	private ?string $genericType = null;

	use ItemAccess;

	/**
	 * @param array<int|string,T> $items
	 *
	 * @implements \IteratorAggregate<int|string, T>
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function __construct(private array $items = [])
	{
		if (!empty($items)) {
			$this->detectGeneric(reset($items));

			foreach ($items as $element) {
				$this->typeMismatchChecking($element);
			}
		}
	}

	/**
	 * @return null|T
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function __get(string $name): mixed
	{
		return $this->get($name);
	}

	/**
	 * @param T $value
	 */
	public function __set(string $name, mixed $value): void
	{
		$this->items[$name] = $value;
	}

	public function exists(int|string $name): bool
	{
		return isset($this->items[$name]);
	}

	public function count(): int
	{
		return count($this->items);
	}

	public function each(callable $callback): void
	{
		array_walk($this->items, $callback);
	}

	/**
	 * @template U
	 *
	 * @param callable(T): U $callback
	 *
	 * @return Set<U>
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function map(callable $callback): self
	{
		return new self(array_map($callback, $this->items));
	}

	/**
	 * @return Set<T>
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function pluck(string $key): self
	{
		$nestedKeys = explode('.', $key);

		/** @var T[] $result */
		$result = $this->items;

		foreach ($nestedKeys as $column) {
			/** @var T[] $result */
			$result = array_column($result, $column);
		}

		return new self($result);
	}

	/**
	 * @return Set<T>
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function add(mixed $key, mixed $value = null): self
	{
		if (is_null($value)) {
			$this->detectGeneric($key);
			$this->typeMismatchChecking($key);
			$this->items[] = $key;

			return $this;
		}

		$this->detectGeneric($value);
		$this->typeMismatchChecking($value);

		Assert::true(is_int($key) || is_string($key), 'Provided Key is not integer or string.');
		// @phpstan-ignore offsetAccess.invalidOffset
		$this->items[$key] = $value;

		return $this;
	}

	/**
	 * @return Set<T>
	 */
	public function remove(int|string $key): self
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

	/**
	 * @return null|T
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function get(int|string $key, mixed $default = null): mixed
	{
		if (!is_null($default)) {
			$this->typeMismatchChecking($default);
		}

		if (is_int($key)) {
			$indexValue = current(array_slice($this->items, $key, 1));

			return $indexValue ?: null;
		}

		return $this->items[$key] ?? $default;
	}

	/**
	 * @return array<T>
	 */
	public function toArray(): array
	{
		return $this->items;
	}

	/**
	 * @return \ArrayIterator<int|string, T>
	 */
	public function getIterator(): \ArrayIterator
	{
		return new \ArrayIterator($this->items);
	}

	/**
	 * @throws GenericMismatchException|\Throwable
	 */
	private function typeMismatchChecking(mixed $value): void
	{
		throwIf($this->genericType !== gettype($value), new GenericMismatchException());
	}

	private function detectGeneric(mixed $value): void
	{
		if (is_null($this->genericType)) {
			$this->genericType = gettype($value);
		}
	}

	/**
	 * @param Sorter<T> $sorter
	 *
	 * @return Set<T>
	 */
	public function sort(Sorter $sorter): self
	{
		return $sorter->sort($this);
	}

	/**
	 * @param Searcher<T> $searcher
	 *
	 * @return Set<T>
	 */
	public function search(mixed $needle, Searcher $searcher): self
	{
		return $searcher->search($this, $needle);
	}

	/**
	 * @return Set<T>
	 *
	 * @throws GenericMismatchException|\Throwable
	 */
	public function filter(callable $callback): self
	{
		return new self(array_filter($this->items, $callback));
	}
}
