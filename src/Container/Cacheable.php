<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Container;

use Sakoo\Framework\Core\Container\Exceptions\ClassNotFoundException;
use Sakoo\Framework\Core\Container\Exceptions\ClassNotInstantiableException;
use Sakoo\Framework\Core\Container\Exceptions\ContainerCacheException;
use Sakoo\Framework\Core\Container\Parameter\ParameterSet;

trait Cacheable
{
	private function prepareGenerateCache(): string
	{
		return '<?php' . PHP_EOL . PHP_EOL . 'return [' . PHP_EOL;
	}

	/**
	 * @param array<callable|object|string> $mappingList
	 */
	private function doGenerateCache(string $key, array $mappingList): string
	{
		$content = "\t'$key' => [" . PHP_EOL;

		foreach ($mappingList as $id => $value) {
			$content .= "\t\t" . var_export($id, true) . ' => ' . print_r($value, true) . ',' . PHP_EOL;
		}
		$content .= "\t" . '],' . PHP_EOL;

		return $content;
	}

	private function postGenerateCache(): string
	{
		return '];' . PHP_EOL;
	}

	/**
	 * @throws \Throwable
	 */
	public function loadCache(): void
	{
		throwUnless($this->cacheExists(), new ContainerCacheException('Cache does not exist'));

		/** @var null|array<callable|object|string>[] $data */
		$data = include "$this->cachePath/container.cache.php";

		if (isset($data['bindings'], $data['singletons'])) {
			$this->bindings = $data['bindings'];
			$this->singletons = $data['singletons'];
		}
	}

	public function flushCache(): bool
	{
		if ($this->cacheExists()) {
			return unlink("$this->cachePath/container.cache.php");
		}

		return false;
	}

	/**
	 * @throws \Throwable
	 * @throws \ReflectionException
	 * @throws ClassNotInstantiableException
	 * @throws ClassNotFoundException
	 */
	private function getTypeFactory(mixed $factory): mixed
	{
		return match (true) {
			is_string($factory) && empty($factory) => "''",
			is_string($factory) && class_exists($factory) => $this->getClassFactory($factory),
			is_object($factory) => $this->getClassFactory($factory::class),
			is_callable($factory) => var_export($factory, true),
			default => $factory,
		};
	}

	/**
	 * @param class-string $class
	 *
	 * @throws \Throwable
	 * @throws ClassNotInstantiableException
	 * @throws \ReflectionException
	 * @throws ClassNotFoundException
	 */
	private function getClassFactory(string $class): string
	{
		$reflection = new \ReflectionClass($class);

		throwUnless($reflection->isInstantiable(), new ClassNotInstantiableException());

		$constructor = $reflection->getConstructor();

		if (!$this->canAutowire($constructor)) {
			return "new \\{$class}()";
		}

		/** @var \ReflectionMethod $constructor */
		$parameterSet = new ParameterSet($this);
		$params = $parameterSet->resolve($constructor->getParameters());
		$dependencies = array_map(fn ($param) => $this->getTypeFactory($param), $params);

		return "new \\{$class}(" . implode(', ', $dependencies) . ')';
	}

	public function cacheExists(): bool
	{
		return !is_null($this->cachePath) && file_exists("$this->cachePath/container.cache.php");
	}

	/**
	 * @throws \Throwable
	 * @throws \ReflectionException
	 * @throws ClassNotInstantiableException
	 * @throws ClassNotFoundException
	 */
	public function dumpCache(): void
	{
		throwIf(is_null($this->cachePath), new ContainerCacheException('Cache is not enabled'));

		/** @var array<callable|object|string> $bindings */
		$bindings = array_map(fn ($factory) => $this->getTypeFactory($factory), $this->bindings);
		/** @var array<callable|object|string> $singletons */
		$singletons = array_map(fn ($factory) => $this->getTypeFactory($factory), $this->singletons);

		$this->flushCache();

		$content = $this->prepareGenerateCache();
		$content .= $this->doGenerateCache('bindings', $bindings);
		$content .= $this->doGenerateCache('singletons', $singletons);
		$content .= $this->postGenerateCache();

		file_put_contents("$this->cachePath/container.cache.php", $content);
	}
}
