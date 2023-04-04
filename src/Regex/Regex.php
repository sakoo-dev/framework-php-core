<?php

namespace Sakoo\Framework\Core\Regex;

class Regex
{
	public const ALPHABET_UPPER = 'A-Z';
	public const ALPHABET_LOWER = 'a-z';
	public const DIGITS = '0-9';
	public const UNDERLINE = '_';
	public const DOT = '.';

	private function __construct(private string $pattern = '')
	{
	}

	public static function make(): static
	{
		return new static();
	}

	public function append(string $value): static
	{
		$this->add($this->escapeChars($value));
		return $this;
	}

	public function add(string $value): static
	{
		$this->pattern .= $value;
		return $this;
	}

	public function startOfLine(): static
	{
		$this->add('^');
		return $this;
	}

	public function endOfLine(): static
	{
		$this->add('$');
		return $this;
	}

	public function startsWith(string|callable $value): static
	{
		$this->startOfLine();
		$this->callOrAppend($value);
		return $this;
	}

	public function endsWith(string|callable $value): static
	{
		$this->callOrAppend($value);
		$this->endOfLine();
		return $this;
	}

	public function digit(int $length = 0): static
	{
		$this->add('\d' . ($length > 0 ? '{' . $length . '}' : ''));
		return $this;
	}

	public function oneOf(array $value): static
	{
		$this->wrap(fn ($exp) => $this->add(implode('|', $value)), true);
		return $this;
	}

	public function wrap(callable $fn, bool $nonCapturing = false): static
	{
		$this->add('(' . ($nonCapturing ? '?:' : ''));
		$fn($this);
		$this->add(')');
		return $this;
	}

	public function bracket(callable $fn): static
	{
		$this->add('[');
		$fn($this);
		$this->add(']');
		return $this;
	}

	public function maybe(string $value): static
	{
		$this->append($value);
		$this->add('?');
		return $this;
	}

	public function anything(): static
	{
		$this->add('.*');
		return $this;
	}

	public function something(): static
	{
		$this->add('.+');
		return $this;
	}

	public function unixLineBreak(): static
	{
		$this->append('\n');
		return $this;
	}

	public function windowsLineBreak(): static
	{
		$this->append('\r\n');
		return $this;
	}

	public function tab(): static
	{
		$this->append('\t');
		return $this;
	}

	public function space(): static
	{
		$this->append('\s');
		return $this;
	}

	public function word(): static
	{
		$this->append('\w');
		return $this;
	}

	public function chars(...$values): static
	{
		$this->add(implode('', $values));
		return $this;
	}

	public function anythingWithout(string|callable $value): static
	{
		$this->add('[^');
		$this->callOrAppend($value);
		$this->add(']*');
		return $this;
	}

	public function somethingWithout(string|callable $value): static
	{
		$this->add('[^');
		$this->callOrAppend($value);
		$this->add(']+');
		return $this;
	}

	public function anythingWith(string|callable $value): static
	{
		$this->add('[');
		$this->callOrAppend($value);
		$this->add(']*');
		return $this;
	}

	public function somethingWith(string|callable $value): static
	{
		$this->add('[');
		$this->callOrAppend($value);
		$this->add(']+');
		return $this;
	}

	private function callOrAppend(string|callable $value): void
	{
		if (is_callable($value)) {
			$value($this);
		}

		if (is_string($value)) {
			$this->append($value);
		}
	}

	public function escapeChars(string $value): string
	{
		if (empty($value)) {
			return '';
		}

		return preg_quote($value, '/');
	}

	public function match(string $value): array
	{
		$matches = null;
		preg_match("/$this->pattern/", $value, $matches);
		return $matches;
	}

	public function matchAll(string $value): array
	{
		$matches = null;
		preg_match_all("/$this->pattern/", $value, $matches);
		return $matches;
	}

	public function test(string $value): bool
	{
		return !empty($this->match($value));
	}

	public function replace(string $string, string $replace): mixed
	{
		return preg_replace("/$this->pattern/", $replace, $string);
	}

	public function get(): string
	{
		return $this->pattern;
	}

	public function __toString(): string
	{
		return $this->get();
	}
}
