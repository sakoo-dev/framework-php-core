<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc;

use Sakoo\Framework\Core\Doc\Formatters\Formatter;
use Sakoo\Framework\Core\Doc\Object\ClassObject;
use Sakoo\Framework\Core\Doc\Object\NamespaceObject;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Finder\SplFileObject;

readonly class Doc
{
	public function __construct(
		/** @var array<SplFileObject> $files */
		private array $files,
		private Formatter $formatter,
		private Storage $docFile,
	) {}

	public function generate(): void
	{
		$data = $this->getNamespaceBags($this->files);
		$data = $this->formatter->format($data);
		$this->saveInFile($this->docFile, $data);
	}

	private function saveInFile(Storage $docFile, string $data): void
	{
		$docFile->remove();
		$docFile->create();
		$docFile->write($data);
	}

	/**
	 * @param SplFileObject[] $files
	 *
	 * @return NamespaceObject[]
	 */
	private function getNamespaceBags(array $files): array
	{
		$data = [];

		/** @var SplFileObject $file */
		foreach ($files as $file) {
			if (!$file->isClassFile()) {
				continue;
			}

			$reflection = new \ReflectionClass($file->getNamespace());
			$classObject = new ClassObject($reflection);

			if ($classObject->isIllegal()) {
				continue;
			}

			$data[$classObject->getNamespace()][] = $classObject;
		}

		$result = [];

		foreach ($data as $namespace => $classes) {
			$result[] = new NamespaceObject($namespace, $classes);
		}

		return $result;
	}
}
