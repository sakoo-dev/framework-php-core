<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Str;

use Sakoo\Framework\Core\Regex\RegexHelper;

class Str implements Stringable
{
	public function __construct(private string $value = '') {}

	public function length(): int
	{
		return mb_strlen($this->value);
	}

	public function uppercaseWords(): static
	{
		$this->value = ucwords($this->value);

		return $this;
	}

	public function uppercase(): static
	{
		$this->value = mb_strtoupper($this->value);

		return $this;
	}

	public function lowercase(): static
	{
		$this->value = mb_strtolower($this->value);

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
		$arr = RegexHelper::findCamelCase()->split($this);

		if (is_array($arr)) {
			$this->value = implode(' ', $arr);
		}

		$str = RegexHelper::getSpecialChars()->replace($this, ' ');

		if (is_string($str)) {
			$this->value = $str;
		}

		$str = RegexHelper::getSpaceBetweenWords()->replace($this, '-');

		if (is_string($str)) {
			$this->value = $str;
		}

		$this->trim();

		return $this->lowercase();
	}

	public function camelCase(): static
	{
		$arr = RegexHelper::findCamelCase()->split($this);

		if (is_array($arr)) {
			$this->value = implode(' ', $arr);
		}

		$str = RegexHelper::getSpecialChars()->replace($this, ' ');

		if (is_string($str)) {
			$this->value = $str;
		}

		$this->lowercase();
		$this->uppercaseWords();

		$str = RegexHelper::getSpaceBetweenWords()->replace($this, '');

		if (is_string($str)) {
			$this->value = $str;
		}

		$this->trim();

		return $this->lowerFirst();
	}

	public function snakeCase(): static
	{
		$arr = RegexHelper::findCamelCase()->split($this);

		if (is_array($arr)) {
			$this->value = implode(' ', $arr);
		}

		$str = RegexHelper::getSpecialChars()->replace($this, ' ');

		if (is_string($str)) {
			$this->value = $str;
		}

		$str = RegexHelper::getSpaceBetweenWords()->replace($this, '_');

		if (is_string($str)) {
			$this->value = $str;
		}

		$this->trim();

		return $this->lowercase();
	}

	public function kebabCase(): static
	{
		return $this->slug();
	}

	public function get(): string
	{
		return $this->value;
	}

	public function __toString()
	{
		return $this->get();
	}

	public static function fromType(mixed $value): self
	{
		if (is_null($value)) {
			return new self("'NULL'");
		}

		if (is_bool($value)) {
			return new self($value ? "'true'" : "'false'");
		}

		if (is_callable($value)) {
			return new self('Closure ' . spl_object_hash((object) $value));
		}

		if (is_object($value)) {
			return new self('Object ' . spl_object_hash($value));
		}

		if (is_array($value)) {
			return new self(sprintf('Array(%s)', count($value)));
		}

		// @phpstan-ignore argument.type
		return new self(strval($value));
	}
}
