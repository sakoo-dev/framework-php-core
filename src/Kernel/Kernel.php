<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel;

use Psr\Container\ContainerInterface;
use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Kernel\Exceptions\KernelTwiceCallException;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Profiler\ProfilerInterface;

class Kernel
{
	private static ?Kernel $instance = null;

	private ProfilerInterface $profiler;
	private ContainerInterface $container;

	private string $serverTimezone;
	private $errorHandler;
	private $exceptionHandler;

	private array $serviceLoaders;

	private function __construct(
		private readonly Mode $mode,
		private readonly Environment $environment,
	) {}

	public static function prepare(Mode $mode, Environment $environment): static
	{
		if (!is_null(static::$instance)) {
			throw new KernelTwiceCallException();
		}

		return static::$instance = new static($mode, $environment);
	}

	public static function getInstance(): ?static
	{
		return static::$instance;
	}

	public function run(): void
	{
		if (!empty($this->serverTimezone)) {
			date_default_timezone_set($this->serverTimezone);
		}

		if (!empty($this->errorHandler)) {
			set_error_handler($this->errorHandler);
		}

		if (!empty($this->exceptionHandler)) {
			set_exception_handler($this->exceptionHandler);
		}

		if ($this->isInTestMode() || $this->isInDebugEnv()) {
			$this->enableDisplayErrors();
		}

		require_once Path::getCoreDir() . '/helpers.php';

		$this->container = new Container();

		set($this->serviceLoaders)->each(
			fn ($serviceLoader) => (new $serviceLoader())->load($this->container)
		);

		// What?
		resolve(ProfilerInterface::class);
	}

	public function getMode(): Mode
	{
		return $this->mode;
	}

	public function getEnvironment(): Environment
	{
		return $this->environment;
	}

	public function getProfiler(): ProfilerInterface
	{
		return $this->profiler;
	}

	public function getContainer(): ContainerInterface
	{
		return $this->container;
	}

	public function setExceptionHandler(callable $handler): static
	{
		$this->exceptionHandler = $handler;

		return $this;
	}

	public function setErrorHandler(callable $handler): static
	{
		$this->errorHandler = $handler;

		return $this;
	}

	public function setServerTimezone(string $timezone): static
	{
		$this->serverTimezone = $timezone;

		return $this;
	}

	public function setServiceLoaders(array $serviceLoaders): static
	{
		$this->serviceLoaders = $serviceLoaders;

		return $this;
	}

	public function isInTestMode(): bool
	{
		return Mode::Test === $this->mode;
	}

	public function isInHttpMode(): bool
	{
		return Mode::HTTP === $this->mode;
	}

	public function isInConsoleMode(): bool
	{
		return Mode::Console === $this->mode;
	}

	public function isInDebugEnv(): bool
	{
		return Environment::Debug === $this->environment;
	}

	public function isInProductionEnv(): bool
	{
		return Environment::Production === $this->environment;
	}

	private function enableDisplayErrors(): void
	{
		ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
}
