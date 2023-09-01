<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\FileSystem\Storages\Local;

trait CanBeWritable
{
	private function writeToFile($data, $mode): bool
	{
		$this->mkdir();
		$file = fopen($this->path, $mode);
		$result = false;

		if (!$file) {
			return $result;
		}

		if (flock($file, LOCK_EX)) {
			$result = fwrite($file, $data);
			fflush($file);
			flock($file, LOCK_UN);
		}

		fclose($file);

		return (bool) $result;
	}
}
