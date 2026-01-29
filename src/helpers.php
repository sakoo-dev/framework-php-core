<?php

declare(strict_types=1);

use Psr\Log\LoggerInterface;
use Sakoo\Framework\Core\Container\Contracts\ContainerInterface;
use Sakoo\Framework\Core\Kernel\Exceptions\KernelIsNotStartedException;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Set\IterableInterface;
use Sakoo\Framework\Core\Set\Set;
use Sakoo\Framework\Core\Str\Str;
use Sakoo\Framework\Core\Str\Stringable;
use Sakoo\Framework\Core\VarDump\VarDump;

if (!function_exists('set')) {
	/**
	 * @template T
	 *
	 * @param T[] $value
	 *
	 * @return IterableInterface<T>
	 *
	 * @throws InvalidArgumentException|Throwable
	 */
	function set(array $value = []): IterableInterface
	{
		return new Set($value);
	}
}

if (!function_exists('kernel')) {
	/**
	 * @throws KernelIsNotStartedException
	 */
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
	/**
	 * @template T
	 *
	 * @param class-string<T> $interface
	 *
	 * @return T
	 */
	function resolve(string $interface)
	{
		// @phpstan-ignore return.type
		return container()->resolve($interface);
	}
}

if (!function_exists('makeInstance')) {
	/**
	 * @param mixed[] $args
	 */
	function makeInstance(string $class, array $args = []): object
	{
		return container()->new($class, $args);
	}
}

if (!function_exists('throwIf')) {
	/**
	 * @throws Throwable
	 */
	function throwIf(bool $condition, Throwable $exception): void
	{
		if ($condition) {
			throw $exception;
		}
	}
}

if (!function_exists('throwUnless')) {
	/**
	 * @throws Throwable
	 */
	function throwUnless(bool $condition, Throwable $exception): void
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
	function dump(mixed ...$values): void
	{
		VarDump::dump(...$values);
	}
}

if (!function_exists('dd')) {
	function dd(mixed ...$values): never
	{
		VarDump::dieDump(...$values);
	}
}
