<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Watcher;

enum EventTypes
{
	case MODIFY;

	case MOVE;

	case DELETE;
}
