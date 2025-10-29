<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Regex;

use Sakoo\Framework\Core\Str\Stringable;

class Regex implements \Stringable
{
	final public const string ALPHABET_UPPER = 'A-Z';
	final public const string ALPHABET_LOWER = 'a-z';
	final public const string DIGITS = '0-9';
	final public const string UNDERLINE = '_';
	final public const string DOT = '.';

	public function __construct(private string $pattern = '') {}

	public function safeAdd(string $value): static
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

	public function startsWith(callable|string $value): static
	{
		$this->startOfLine();
		$this->callOrAdd($value);

		return $this;
	}

	public function endsWith(callable|string $value): static
	{
		$this->callOrAdd($value);
		$this->endOfLine();

		return $this;
	}

	public function digit(int $length = 0): static
	{
		$this->add('\d' . ($length > 0 ? '{' . $length . '}' : ''));

		return $this;
	}

	/**
	 * @param string[] $value
	 */
	public function oneOf(array $value): static
	{
		$this->wrap(fn ($exp) => $this->add(implode('|', $value)), true);

		return $this;
	}

	public function wrap(callable|string $value, bool $nonCapturing = false): static
	{
		$this->add('(' . ($nonCapturing ? '?:' : ''));
		$this->callOrAdd($value);
		$this->add(')');

		return $this;
	}

	public function bracket(callable|string $value): static
	{
		$this->add('[');
		$this->callOrAdd($value);
		$this->add(']');

		return $this;
	}

	public function maybe(string $value): static
	{
		$this->safeAdd($value);
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
		$this->add('\n');

		return $this;
	}

	public function windowsLineBreak(): static
	{
		$this->add('\r\n');

		return $this;
	}

	public function tab(): static
	{
		$this->add('\t');

		return $this;
	}

	public function space(): static
	{
		$this->add('\s');

		return $this;
	}

	public function word(): static
	{
		$this->add('\w');

		return $this;
	}

	public function chars(string ...$values): static
	{
		$this->add(implode('', $values));

		return $this;
	}

	public function anythingWithout(callable|string $value): static
	{
		$this->add('[^');
		$this->callOrAdd($value);
		$this->add(']*');

		return $this;
	}

	public function somethingWithout(callable|string $value): static
	{
		$this->add('[^');
		$this->callOrAdd($value);
		$this->add(']+');

		return $this;
	}

	public function anythingWith(callable|string $value): static
	{
		$this->add('[');
		$this->callOrAdd($value);
		$this->add(']*');

		return $this;
	}

	public function somethingWith(callable|string $value): static
	{
		$this->add('[');
		$this->callOrAdd($value);
		$this->add(']+');

		return $this;
	}

	private function callOrAdd(callable|string $value): void
	{
		if (is_callable($value)) {
			$value($this);
		}

		if (is_string($value)) {
			$this->safeAdd($value);
		}
	}

	public function escapeChars(string $value): string
	{
		if (empty($value)) {
			return '';
		}

		return preg_quote($value, '/');
	}

	public function lookahead(callable|string $value): static
	{
		$this->wrap(function (Regex $exp) use ($value): void {
			$exp->add('?=');
			$this->callOrAdd($value);
		});

		return $this;
	}

	public function lookbehind(callable|string $value): static
	{
		$this->wrap(function (Regex $exp) use ($value): void {
			$exp->add('?<=');
			$this->callOrAdd($value);
		});

		return $this;
	}

	public function negativeLookahead(callable|string $value): static
	{
		$this->wrap(function (Regex $exp) use ($value): void {
			$exp->add('?!');
			$this->callOrAdd($value);
		});

		return $this;
	}

	public function negativeLookbehind(callable|string $value): static
	{
		$this->wrap(function (Regex $exp) use ($value): void {
			$exp->add('?<!');
			$this->callOrAdd($value);
		});

		return $this;
	}

	/**
	 * @return string[]
	 */
	public function match(string $value): array
	{
		$matches = null;
		preg_match("/$this->pattern/", $value, $matches);

		return $matches;
	}

	/**
	 * @return string[][]
	 */
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

	/**
	 * @return null|string|string[]
	 */
	public function replace(string|Stringable $string, string $replace): array|string|null
	{
		return preg_replace("/$this->pattern/", $replace, "$string");
	}

	/**
	 * @return false|string[]
	 */
	public function split(string|Stringable $subject): array|false
	{
		return preg_split("/$this->pattern/", "$subject");
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
