<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Markup;

class Markdown implements Markup
{
	private string $markdown = '';

	public function __construct() {}

	public function write(string $value): void
	{
		$this->markdown .= $value;
	}

	public function writeLine(string $value): void
	{
		$this->write($value);
		$this->br();
	}

	public function br(): void
	{
		$this->markdown .= PHP_EOL . PHP_EOL;
	}

	public function fbr(): void
	{
		$this->markdown .= '<br>';
	}

	public function callout(string $value): void
	{
		$this->writeLine('> ' . $value);
	}

	public function h1(string $value): void
	{
		$this->writeLine('# ' . $value);
	}

	public function h2(string $value): void
	{
		$this->writeLine('## ' . $value);
	}

	public function h3(string $value): void
	{
		$this->writeLine('### ' . $value);
	}

	public function h4(string $value): void
	{
		$this->writeLine('#### ' . $value);
	}

	public function h5(string $value): void
	{
		$this->writeLine('##### ' . $value);
	}

	public function h6(string $value): void
	{
		$this->writeLine('###### ' . $value);
	}

	public function ul(string $value): void
	{
		$this->writeLine('- ' . $value);
	}

	public function link(string $url, string $text): void
	{
		$this->write("[$text]($url)");
	}

	public function image(string $path, string $alt): void
	{
		$this->write('!');
		$this->link($path, $alt);
	}

	public function checklist(string $value, bool $checked = false): void
	{
		$checked = $checked ? 'X' : '';
		$this->writeLine("[$checked] $value");
	}

	public function hr(): void
	{
		$this->writeLine('---');
	}

	public function code(string $value, string $language): void
	{
		$this->writeLine("```$language\n$value\n```");
	}

	public function inlineCode(string $value): void
	{
		$this->write("`$value`");
	}

	public function tiny(string $value): void
	{
		$this->writeLine("<sub><sup>$value</sup></sub>");
	}

	public function get(): string
	{
		return $this->markdown;
	}

	public function __toString(): string
	{
		return $this->get();
	}
}
