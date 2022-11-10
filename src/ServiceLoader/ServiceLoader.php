<?php

namespace Sakoo\Framework\Core\ServiceLoader;

use Sakoo\Framework\Core\Container\Container;

abstract class ServiceLoader
{
	abstract public function load(Container $container): void;
}
