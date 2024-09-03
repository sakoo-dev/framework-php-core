<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

use Sakoo\Framework\Core\Doc\Formatter;
use Sakoo\Framework\Core\Markdown\Markdown;

class NamespaceBasedFormatter implements Formatter
{
	public function format(array $data): string
	{
		$data = $this->sortData($data);
		$markdown = new Markdown();

		foreach ($data as $namespace => $classes) {
			$markdown->hr();
			$markdown->h2('📦 ' . $namespace);

			foreach ($classes as $class) {
				$icon = $class['extra']['is_exception'] ? '🟥' : '🟩';
				$markdown->h3($icon . ' ' . $class['class']);

				foreach ($class['methods'] as $method) {
					$modifiers = $method['modifiers'] ? implode(' ', $method['modifiers']) . ' ' : '';
					$parameters = $this->prepareParameters($method['parameters']);
					$returnTypes = $method['returnTypes'] ? ': ' . $method['returnTypes'] : '';

					if ('__construct' === $method['name']) {
						$markdown->h4("How to use the Class: \n ```php \n $" . lcfirst($class['class']) . ' = new ' . $class['class'] . "($parameters); \n ```");
					} else {
						$markdown->writeLine("```php \n $modifiers" . $method['name'] . "($parameters)$returnTypes \n ```");
					}

					$markdown->writeLine($method['phpdoc'] ?: 'PHP Docs will appear here');
					$markdown->fbr();
					$markdown->br();
				}
			}
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

	private function prepareParameters($parameters): string
	{
		$result = '';

		foreach ($parameters as $parameter) {
			if ($parameterType = $parameter['type']) {
				$result .= "$parameterType ";
			}

			$result .= '$' . $parameter['name'] . ', ';
		}

		if (str_ends_with($result, ', ')) {
			$result = substr($result, 0, -2);
		}

		return $result;
	}
}
