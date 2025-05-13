<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

class TocFormatter extends Formatter
{
	public function format(array $data): string
	{
		foreach ($data as $namespace => $classes) {
			$this->markup->write('* [' . str_replace('Sakoo\Framework\Core\\', '', $namespace) . '](#-' . strtolower(str_replace([' ', '\\'], ['-', ''], $namespace)) . ')' . PHP_EOL);
		}

		return (string) $this->markup;
	}
}
