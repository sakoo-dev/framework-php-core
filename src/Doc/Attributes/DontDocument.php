<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Attributes;

#[\Attribute(\Attribute::TARGET_ALL)]
final class DontDocument
{
	public function __construct() {}
}
