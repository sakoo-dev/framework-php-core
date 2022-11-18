<?php

namespace Sakoo\Framework\Core\Testing;

interface NeedsKernel
{
	public static function runKernel(): void;
}
