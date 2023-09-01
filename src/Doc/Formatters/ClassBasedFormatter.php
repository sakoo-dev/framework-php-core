<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

use Sakoo\Framework\Core\Doc\Formatter;
use Sakoo\Framework\Core\Markdown\Markdown;

class ClassBasedFormatter implements Formatter
{
	public function format(array $data): string
	{
		$markdown = new Markdown();

		foreach ($data as $class) {
			$icon = $class['extra']['is_exception'] ? '🟥' : '🟩';
			$markdown->hr();
			$markdown->h2($icon . ' ' . $class['class']);
			$markdown->callout('📦 ' . $class['namespace']);

			foreach ($class['methods'] as $method) {
				if ('__construct' === $method['name']) {
					$markdown->h4('How to use the Class: `$' . lcfirst($class['class']) . ' = new ' . $class['class'] . '();`');

					continue;
				}

				$modifiers = $method['modifiers'] ? implode(' ', $method['modifiers']) . ' ' : '';
				$parameters = $this->prepareParameters($method['parameters']);
				$returnTypes = $method['returnTypes'] ? ': ' . $method['returnTypes'] : '';
				$markdown->h4("🟢 ```$modifiers" . $method['name'] . "($parameters)$returnTypes```");
				$markdown->writeLine($method['phpdoc'] ?: 'PHP Docs will appear here');
			}
		}

		return $markdown;
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
