<?php

namespace Sakoo\Framework\Core\Variable;

class Variable
{
	public static function stringify(mixed $value): string
	{
		if (is_bool($value)) {
			return $value ? "'true'" : "'false'";
		}

		if (is_callable($value)) {
			return 'Closure ' . spl_object_hash($value);
		}

		if (is_object($value)) {
			return 'Object ' . spl_object_hash($value);
		}

		if (is_array($value)) {
			return sprintf('Array(%s)', count($value));
		}

		return strval($value);
	}
}
