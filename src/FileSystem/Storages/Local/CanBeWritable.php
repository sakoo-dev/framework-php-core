<?php

namespace Sakoo\Framework\Core\FileSystem\Storages\Local;

trait CanBeWritable
{
	private function writeToFile($data, $mode): bool
	{
		$this->mkdir();
		$file = fopen($this->path, $mode);
		$result = false;

		if (flock($file, LOCK_EX)) {
			$result = fwrite($file, $data);
			fflush($file);
			flock($file, LOCK_UN);
		}

		fclose($file);
		return (bool) $result;
	}
}
