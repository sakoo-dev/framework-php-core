<?php

namespace Sakoo\Framework\Core\Set;

use IteratorAggregate;

interface Iteratable extends IteratorAggregate
{
	public function exists($name): bool;

	public function count(): int;

	public function each($callback): void;

	public function map($callback): static;

	public function add($key, $value = null): static;

	public function remove($key): static;

	public function get($key = null, $default = null): mixed;
}
