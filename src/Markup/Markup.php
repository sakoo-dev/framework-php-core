<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Markup;

abstract class Markup implements \Stringable
{
	abstract public function write(string $value): void;

	abstract public function writeLine(string $value): void;

	abstract public function br(): void;

	abstract public function fbr(): void;

	abstract public function callout(string $value): void;

	abstract public function h1(string $value): void;

	abstract public function h2(string $value): void;

	abstract public function h3(string $value): void;

	abstract public function h4(string $value): void;

	abstract public function h5(string $value): void;

	abstract public function h6(string $value): void;

	abstract public function ul(string $value): void;

	abstract public function link(string $url, string $text): void;

	abstract public function image(string $path, string $alt): void;

	abstract public function checklist(string $value, bool $checked = false): void;

	abstract public function hr(): void;

	abstract public function code(string $value, string $language): void;

	abstract public function inlineCode(string $value): void;

	abstract public function tiny(string $value): void;

	abstract public function get(): string;
}
