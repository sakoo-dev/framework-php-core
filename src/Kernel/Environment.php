<?php

namespace Sakoo\Framework\Core\Kernel;

enum Environment
{
	case Test;
	case Console;
	case HTTP;
}
