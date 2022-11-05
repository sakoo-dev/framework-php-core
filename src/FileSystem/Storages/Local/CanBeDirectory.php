<?php

namespace Sakoo\Framework\Core\FileSystem\Storages\Local;

trait CanBeDirectory
{
	private function removeRecursive($path): bool
	{
		if (!file_exists($path)) {
			return false;
		}

		if (!is_dir($path)) {
			return unlink($path);
		}

		$content = scandir($path);
		unset($content[0], $content[1]);

		set($content)->each(fn ($item) => $this->removeRecursive("$path/$item"));

		return rmdir($path);
	}

	private function copyRecursive(string $src, string $dst): bool
	{
		mkdir(directory: dirname($dst), recursive: true);

		if (is_file($src)) {
			return copy($src, $dst);
		}

		mkdir(directory: $dst);

		$content = scandir($src);
		unset($content[0], $content[1]);

		set($content)->each(fn ($item) => $this->copyRecursive("$src/$item", "$dst/$item"));

		return true;
	}
}
