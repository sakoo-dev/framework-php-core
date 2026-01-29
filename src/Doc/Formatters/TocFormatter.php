<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

class TocFormatter extends Formatter
{
	public function format(array $namespaces): string
	{
		foreach ($namespaces as $namespace) {
			$this->markup->write('* [' . str_replace('Sakoo\Framework\Core\\', '', $namespace->getName()) . '](#-' . strtolower(str_replace([' ', '\\'], ['-', ''], $namespace->getName())) . ')' . PHP_EOL);
		}

		return (string) $this->markup;
	}
}
