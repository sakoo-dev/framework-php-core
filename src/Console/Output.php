<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

class Output
{
	public function block(array|string $content, string $style = ''): void
	{
		echo $this->text($content, $style) . PHP_EOL;
	}

	public function text(array|string $content, string $style = ''): void
	{
		if (is_array($content)) {
			$content = implode(PHP_EOL, $content);
		}

		echo $content;
	}

	public function newLine(): void
	{
		echo PHP_EOL . PHP_EOL;
	}
}
