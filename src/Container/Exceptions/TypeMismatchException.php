<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use Sakoo\Framework\Core\Exception\Exception;

class TypeMismatchException extends Exception implements ContainerExceptionInterface {}
