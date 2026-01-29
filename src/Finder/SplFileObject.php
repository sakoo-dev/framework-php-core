<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Finder;

class SplFileObject extends \SplFileObject
{
	public function isClassFile(): bool
	{
		return class_exists($this->getNamespace());
	}

	/** @return class-string */
	public function getNamespace(): string
	{
		// @phpstan-ignore return.type
		return str_replace(
			['.php', getcwd() . '/src', '/'],
			['', 'Sakoo\Framework\Core', '\\'],
			$this->getRealPath(),
		);
	}
}
