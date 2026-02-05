<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump;

class VarDump
{
	public static function dieDump(mixed ...$vars): never
	{
		static::dump(...$vars);

		exit;
	}

	public static function dump(mixed ...$vars): void
	{
		/** @var Dumper $dumper */
		$dumper = resolve(Dumper::class);

		foreach ($vars as $var) {
			$dumper->dump($var);
		}
	}
}
