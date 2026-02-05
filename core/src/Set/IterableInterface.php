<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Set;

use Sakoo\Framework\Core\Set\Strategy\Searcher;
use Sakoo\Framework\Core\Set\Strategy\Sorter;

/**
 * @template T
 *
 * @extends \IteratorAggregate<int|string, T>
 */
interface IterableInterface extends \IteratorAggregate, \Countable
{
	public function exists(int|string $name): bool;

	public function count(): int;

	public function each(callable $callback): void;

	/**
	 * @template U
	 *
	 * @param callable(T): U $callback
	 *
	 * @return IterableInterface<U>
	 */
	public function map(callable $callback): self;

	/**
	 * @return IterableInterface<T>
	 */
	public function pluck(string $key): self;

	/**
	 * @return IterableInterface<T>
	 */
	public function add(mixed $key, mixed $value = null): self;

	/**
	 * @return IterableInterface<T>
	 */
	public function remove(int|string $key): self;

	/**
	 * @return null|T
	 */
	public function get(int|string $key, mixed $default = null): mixed;

	/**
	 * @param Sorter<T> $sorter
	 *
	 * @return IterableInterface<T>
	 */
	public function sort(Sorter $sorter): self;

	/**
	 * @param Searcher<T> $searcher
	 *
	 * @return IterableInterface<T>
	 */
	public function search(mixed $needle, Searcher $searcher): self;

	/**
	 * @return IterableInterface<T>
	 */
	public function filter(callable $callback): self;

	/**
	 * @return array<mixed>
	 */
	public function toArray(): array;
}
