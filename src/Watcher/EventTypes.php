<?php

namespace Sakoo\Framework\Core\Watcher;

enum EventTypes
{
	case MODIFY;
	case MOVE;
	case DELETE;
}
