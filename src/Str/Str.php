<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Str;

use Sakoo\Framework\Core\Regex\RegexHelper;

class Str implements Stringable
{
	public function __construct(private string $value = '')
	{
	}

	public function length(): int
	{
		return strlen($this->value);
	}

	public function uppercase(): static
	{
		$this->value = strtoupper($this->value);

		return $this;
	}

	public function lowercase(): static
	{
		$this->value = strtolower($this->value);

		return $this;
	}

	public function upperFirst(): static
	{
		$this->value = ucfirst($this->value);

		return $this;
	}

	public function lowerFirst(): static
	{
		$this->value = lcfirst($this->value);

		return $this;
	}

	public function reverse(): static
	{
		$this->value = strrev($this->value);

		return $this;
	}

	public function contains(string $substring): bool
	{
		return str_contains($this->value, $substring);
	}

	public function replace(string $search, string $replace): static
	{
		$this->value = str_replace($search, $replace, $this->value);

		return $this;
	}

	public function trim(): static
	{
		$this->value = trim($this->value);

		return $this;
	}

	public function slug(): static
	{
		$this->value = implode(' ', RegexHelper::findCamelCase()->split($this));
		$this->value = RegexHelper::getSpecialChars()->replace($this, ' ');
		$this->value = RegexHelper::getSpaceBetweenWords()->replace($this, '-');

		$this->trim();

		return $this->lowercase();
	}

	public function camelCase(): static
	{
		$words = RegexHelper::getSpecialChars()->split($this);
		$this->value = implode(array_map('ucfirst', $words));

		return $this->lowerFirst();
	}

	public function get(): string
	{
		return $this->value;
	}

	public function __toString()
	{
		return $this->get();
	}
}
