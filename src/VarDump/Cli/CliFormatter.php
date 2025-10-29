<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump\Cli;

use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\VarDump\Formatter;

readonly class CliFormatter implements Formatter
{
	public function __construct(private Output $output) {}

	public function format(mixed $value): void
	{
		$this->output->write($this->formatType($value));
	}

	protected function formatType(mixed $value, int $depth = 0): string
	{
		return match (gettype($value)) {
			'string' => $this->output->formatText('"' . $value . '"', Output::COLOR_YELLOW),
			'integer', 'double' => $this->output->formatText("$value", Output::COLOR_RED),
			'boolean' => $this->output->formatText($value ? 'true' : 'false', Output::COLOR_GREEN),
			'NULL' => $this->output->formatText('null', Output::COLOR_RED),
			'array' => $this->formatArray($value, $depth),
			'object' => $this->formatObject($value, $depth),
			// @phpstan-ignore argument.type
			default => $this->output->formatText(strval($value)),
		};
	}

	// @phpstan-ignore missingType.iterableValue
	private function formatArray(array $value, int $depth): string
	{
		$indent = str_repeat("\t", $depth);
		$out = $this->output->formatText('Array', Output::COLOR_CYAN) . '(' . count($value) . ") [\n";

		foreach ($value as $key => $val) {
			$out .= $indent . '  [' . $this->output->formatText("$key", Output::COLOR_GREEN) . '] => ' . $this->formatType($val, $depth + 1) . "\n";
		}

		return $out . $indent . ']';
	}

	private function formatObject(object $value, int $depth): string
	{
		$indent = str_repeat("\t", $depth);
		$class = $value::class;
		$out = $this->output->formatText("object($class)", Output::COLOR_MAGENTA) . " {\n";

		$reflectionClass = new \ReflectionClass($value);

		foreach ($reflectionClass->getProperties() as $property) {
			$type = '';

			if ($property->getType() instanceof \ReflectionNamedType) {
				$type = $property->getType()->getName();
			}

			$out .= $indent . '  ' . ($property->isPrivate() ? '-' : '+') . $type . ' ' . $this->output->formatText($property->getName(), Output::COLOR_GREEN) . ': ' . $this->formatType($property->getValue($value), $depth + 1) . "\n";
		}

		return $out . $indent . '}';
	}
}
