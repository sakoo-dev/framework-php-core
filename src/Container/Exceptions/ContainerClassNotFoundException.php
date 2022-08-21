<?php

namespace Sakoo\Framework\Core\Container\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use Sakoo\Framework\Core\Exception\Exception;

class ContainerClassNotFoundException extends Exception implements ContainerExceptionInterface
{
}
