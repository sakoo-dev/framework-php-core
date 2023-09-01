<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Sakoo\Framework\Core\Container\ContainerInterface;
use Sakoo\Framework\Core\Exception\Exception;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Set\Iteratable;
use Sakoo\Framework\Core\Set\Set;
use Sakoo\Framework\Core\Str\Str;
use Sakoo\Framework\Core\Str\Stringable;

if (!function_exists('set')) {
	function set(array $value = []): Iteratable
	{
		return Set::make($value);
	}
}

if (!function_exists('kernel')) {
	function kernel(): Kernel
	{
		return Kernel::getInstance();
	}
}

if (!function_exists('container')) {
	function container(): ContainerInterface
	{
		return kernel()->getContainer();
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
	function throwIf(bool $condition, Exception $exception): void
	{
		if ($condition) {
			throw $exception;
		}
	}
}

if (!function_exists('throwUnless')) {
	function throwUnless(bool $condition, Exception $exception): void
	{
		throwIf(!$condition, $exception);
	}
}

if (!function_exists('logger')) {
	function logger(): LoggerInterface
	{
		return resolve(LoggerInterface::class);
	}
}

if (!function_exists('str')) {
	function str(string $value): Stringable
	{
		return new Str($value);
	}
}

if (!function_exists('__')) {
	function __(string $value): string
	{
		return $value;
	}
}
