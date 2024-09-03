<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

use Sakoo\Framework\Core\Doc\Formatter;
use Sakoo\Framework\Core\Markdown\Markdown;

class TocFormatter implements Formatter
{
	public function format(array $data): string
	{
		$data = $this->sortData($data);
		$markdown = new Markdown();

		foreach ($data as $namespace => $classes) {
			$markdown->write('* [' . str_replace('Sakoo\Framework\Core\\', '', $namespace) . '](#-' . strtolower(str_replace([' ', '\\'], ['-', ''], $namespace)) . ')' . PHP_EOL);
		}

		return (string) $markdown;
	}

	private function sortData(array $data): array
	{
		$result = [];

		foreach ($data as $class) {
			$result[$class['namespace']][] = $class;
		}

		return $result;
	}
}
