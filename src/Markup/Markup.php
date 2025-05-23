<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Markup;

interface Markup extends \Stringable
{
	public function write(string $value): void;

	public function writeLine(string $value): void;

	public function br(): void;

	public function fbr(): void;

	public function callout(string $value): void;

	public function h1(string $value): void;

	public function h2(string $value): void;

	public function h3(string $value): void;

	public function h4(string $value): void;

	public function h5(string $value): void;

	public function h6(string $value): void;

	public function ul(string $value): void;

	public function link(string $url, string $text): void;

	public function image(string $path, string $alt): void;

	public function checklist(string $value, bool $checked = false): void;

	public function hr(): void;

	public function code(string $value, string $language): void;

	public function inlineCode(string $value): void;

	public function tiny(string $value): void;

	public function get(): string;
}
