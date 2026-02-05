<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Set\Strategy;

use Sakoo\Framework\Core\Set\Set;

/**
 * @template T
 */
interface Sorter
{
	/**
	 * @param Set<T> $items
	 *
	 * @return Set<T>
	 */
	public function sort(Set $items): Set;
}
