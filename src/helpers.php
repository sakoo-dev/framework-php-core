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
use Sakoo\Framework\Core\VarDump\VarDump;

if (!function_exists('set')) {
	function set(array $value = []): Iteratable
	{
		return new Set($value);
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

if (!function_exists('dump')) {
	function dump(string $value): void
	{
		(new VarDump($value))->dump();
	}
}

if (!function_exists('dd')) {
	function dd(string $value): never
	{
		(new VarDump($value))->dieDump();
	}
}
