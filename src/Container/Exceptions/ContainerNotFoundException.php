<?php

namespace Sakoo\Framework\Core\Container\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Sakoo\Framework\Core\Exception\Exception;

class ContainerNotFoundException extends Exception implements NotFoundExceptionInterface
{
}
