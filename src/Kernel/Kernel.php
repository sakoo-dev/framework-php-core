<?php

namespace Sakoo\Framework\Core\Kernel;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Kernel\Exceptions\KernelTwiceCallException;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Profiler\Profiler;

class Kernel
{
	private static ?Kernel $instance = null;

	private Mode $mode;
	private Environment $environment;

	private Profiler $profiler;
	private Container $container;

	private string $serverTimezone;
	private $errorHandler;
	private $exceptionHandler;

	private array $serviceLoaders;

	private function __construct(Mode $mode, Environment $environment)
	{
		$this->mode = $mode;
		$this->environment = $environment;
	}

	public static function prepare(Mode $mode, Environment $environment): static
	{
		require_once Path::getCoreDir() . '/helpers.php';

		throwUnless(is_null(static::$instance), new KernelTwiceCallException());
		return static::$instance = new static($mode, $environment);
	}

	public static function getInstance(): ?static
	{
		return static::$instance;
	}

	public function run(): void
	{
		date_default_timezone_set($this->serverTimezone);
		set_error_handler($this->errorHandler);
		set_exception_handler($this->exceptionHandler);

		$this->profiler = new Profiler();
		$this->container = new Container();

		set($this->serviceLoaders)->each(
			fn ($serviceLoader) => (new $serviceLoader())->load($this->container)
		);
	}

	public function getMode(): Mode
	{
		return $this->mode;
	}

	public function getEnvironment(): Environment
	{
		return $this->environment;
	}

	public function getProfiler(): Profiler
	{
		return $this->profiler;
	}

	public function getContainer(): Container
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
}
