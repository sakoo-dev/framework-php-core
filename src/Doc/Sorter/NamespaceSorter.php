<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Sorter;

class NamespaceSorter implements Sorter
{
	public function sort(array $data): array
	{
		$result = [];

		foreach ($data as $class) {
			$result[$class->getNamespace()][] = $class;
		}

		return $result;
	}
}
