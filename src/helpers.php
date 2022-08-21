<?php

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Set\Set;

if (!function_exists('set')) {
	function set(array $value = []): Set
	{
		return Set::make($value);
	}
}

if (!function_exists('kernel')) {
	function kernel(): Kernel
	{
		global $kernel;
		return $kernel;
	}
}

if (!function_exists('container')) {
	function container(): Container
	{
		return kernel()->container;
	}
}

if (!function_exists('bind')) {
	function bind($interface, $object): void
	{
		container()->bind($interface, $object);
	}
}

if (!function_exists('singleton')) {
	function singleton($interface, $object): void
	{
		container()->singleton($interface, $object);
	}
}

if (!function_exists('resolve')) {
	function resolve($interface): mixed
	{
		return container()->resolve($interface);
	}
}

if (!function_exists('makeInstance')) {
	function makeInstance($interface): object
	{
		return container()->new($interface);
	}
}

if (!function_exists('throwIf')) {
	function throwIf($condition, $exception)
	{
		if ($condition) {
			throw $exception;
		}
	}
}

if (!function_exists('throwUnless')) {
	function throwUnless($condition, $exception)
	{
		throwIf(!$condition, $exception);
	}
}
