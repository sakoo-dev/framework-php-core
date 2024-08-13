<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\VarDump;

readonly class VarDump
{
	public function __construct(private mixed $value) {}

	public function dump(): void
	{
		var_dump($this->value);
	}

	public function dieDump(): never
	{
		$this->dump();

		exit;
	}

	public function __toString(): string
	{
		if (is_bool($this->value)) {
			return $this->value ? "'true'" : "'false'";
		}

		if (is_callable($this->value)) {
			return 'Closure ' . spl_object_hash((object) $this->value);
		}

		if (is_object($this->value)) {
			return 'Object ' . spl_object_hash($this->value);
		}

		if (is_array($this->value)) {
			return sprintf('Array(%s)', count($this->value));
		}

		return strval($this->value);
	}
}
