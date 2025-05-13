<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel;

enum Environment: string
{
	case Debug = 'Debug';

	case Production = 'Production';
}
