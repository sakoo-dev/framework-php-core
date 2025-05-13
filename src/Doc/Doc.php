<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc;

use Sakoo\Framework\Core\Doc\Formatters\Formatter;
use Sakoo\Framework\Core\Doc\Object\ClassObject;
use Sakoo\Framework\Core\Doc\Sorter\Sorter;
use Sakoo\Framework\Core\FileSystem\Storage;

readonly class Doc
{
	public function __construct(
		private array $files,
		private Formatter $formatter,
		private Sorter $sorter,
		private Storage $docFile,
	) {}

	public function generate(): void
	{
		$data = $this->getDataFromFiles($this->files);
		$data = $this->sorter->sort($data);
		$data = $this->formatter->format($data);
		$this->saveInFile($this->docFile, $data);
	}

	private function saveInFile(Storage $docFile, string $data): void
	{
		$docFile->remove();
		$docFile->create();
		$docFile->write($data);
	}

	private function getDataFromFiles(array $files): array
	{
		$data = [];

		foreach ($files as $file) {
			if (!$file->isClass()) {
				continue;
			}

			$reflection = new \ReflectionClass($file->getNamespace());
			$classObject = new ClassObject($reflection);

			if (!$classObject->isIllegal()) {
				$data[] = $classObject;
			}
		}

		return $data;
	}
}
