<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing;

interface NeedsKernel
{
	public static function runKernel(): void;
}
