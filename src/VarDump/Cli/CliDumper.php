<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump\Cli;

use Sakoo\Framework\Core\VarDump\Dumper;
use Sakoo\Framework\Core\VarDump\Formatter;

readonly class CliDumper implements Dumper
{
	public function __construct(private Formatter $formatter) {}

	public function dump(mixed $value): void
	{
		$this->formatter->format($value);
	}
}
