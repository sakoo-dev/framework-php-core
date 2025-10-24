<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump;

interface Formatter
{
	public function format(mixed $value): void;
}
