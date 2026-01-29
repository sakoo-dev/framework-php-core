<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump;

interface Dumper
{
	public function dump(mixed $value): void;
}
