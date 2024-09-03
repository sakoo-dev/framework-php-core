<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Set;

interface Iteratable extends \IteratorAggregate, \Countable
{
	public function exists($name): bool;

	public function count(): int;

	public function each($callback): void;

	public function map($callback): static;

	public function add($key, $value = null): static;

	public function remove($key): static;

	public function get($key = null, $default = null): mixed;
}
