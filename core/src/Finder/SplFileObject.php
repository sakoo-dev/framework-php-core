<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Finder;

use Sakoo\Framework\Core\Path\Path;

class SplFileObject extends \SplFileObject
{
	public function isClassFile(): bool
	{
		return class_exists($this->getNamespace());
	}

	/** @return class-string */
	public function getNamespace(): string
	{
		$relativePath = 'src' . str_replace(Path::getCoreDir() ?: '', '', $this->getRealPath());

		return Path::pathToNamespace($relativePath);
	}
}
