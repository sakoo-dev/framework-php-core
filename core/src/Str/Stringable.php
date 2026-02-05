<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Str;

interface Stringable extends \Stringable
{
	public function length(): int;

	public function uppercase(): static;

	public function lowercase(): static;

	public function uppercaseWords(): static;

	public function upperFirst(): static;

	public function lowerFirst(): static;

	public function reverse(): static;

	public function contains(string $substring): bool;

	public function replace(string $search, string $replace): static;

	public function trim(): static;

	public function slug(): static;

	public function camelCase(): static;

	public function get(): string;
}
