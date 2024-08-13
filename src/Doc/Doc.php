<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc;

use Sakoo\Framework\Core\Doc\Reflection\ReflectionClass;
use Sakoo\Framework\Core\Doc\Reflection\ReflectionMethod;
use Sakoo\Framework\Core\Doc\Reflection\ReflectionType;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;
use Symfony\Component\Finder\Finder;

class Doc
{
	use ReflectionClass;
	use ReflectionMethod;
	use ReflectionType;

	public function __construct(
		private readonly Finder $finder,
		private readonly Formatter $formatter,
	) {}

	public function generate(): void
	{
		$data = $this->getDataFromFiles($this->finder->files());
		$this->saveInFile($this->formatter->format($data));
	}

	private function saveInFile(string $data): void
	{
		$docFile = File::open(Disk::Local, Path::getStorageDir() . '/doc/Doc.md');
		$docFile->remove();
		$docFile->create();
		$docFile->write($data);
	}

	private function getDataFromFiles(Finder $files): array
	{
		foreach ($files as $file) {
			$namespace = $this->getNamespaceFromPath($file->getRealPath());
			$reflection = new \ReflectionClass($namespace);

			if ($reflection->isTrait() || $reflection->isAbstract() || $reflection->isInterface()) {
				continue;
			}

			$data[] = $this->getClassMethods($reflection);
		}

		return $data;
	}
}
