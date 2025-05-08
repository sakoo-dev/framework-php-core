<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Finder;

class SplFileObject extends \SplFileObject
{
	public function isClass(): bool
	{
		return class_exists($this->getNamespace());
	}

	public function getNamespace(): string
	{
		return str_replace(
			['.php', getcwd() . '/src', '/'],
			['', 'Sakoo\Framework\Core', '\\'],
			$this->getRealPath(),
		);
	}
}
