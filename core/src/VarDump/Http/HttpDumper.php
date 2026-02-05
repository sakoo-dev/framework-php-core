<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump\Http;

use Sakoo\Framework\Core\VarDump\Dumper;
use Sakoo\Framework\Core\VarDump\Formatter;

readonly class HttpDumper implements Dumper
{
	public function __construct(private Formatter $formatter) {}

	public function dump(mixed $value): void
	{
		$this->formatter->format($value);
	}
}
