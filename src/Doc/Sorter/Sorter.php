<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Sorter;

interface Sorter
{
	public function sort(array $data): array;
}
