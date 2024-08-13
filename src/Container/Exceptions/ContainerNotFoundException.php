<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Sakoo\Framework\Core\Exception\Exception;

class ContainerNotFoundException extends Exception implements NotFoundExceptionInterface
{
	public function __construct()
	{
		parent::__construct('Container cannot find a registered class');
	}
}
