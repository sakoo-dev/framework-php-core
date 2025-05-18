<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel;

enum Mode: string
{
	case Test = 'Test';

	case Console = 'Console';

	case HTTP = 'Http';
}
