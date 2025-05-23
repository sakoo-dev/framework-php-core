<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel;

use Sakoo\Framework\Core\Container\Container;
use Sakoo\Framework\Core\Container\ContainerInterface;
use Sakoo\Framework\Core\Kernel\Exceptions\KernelTwiceCallException;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Profiler\ProfilerInterface;
use Sakoo\Framework\Core\ServiceLoader\ServiceLoader;

class Kernel
{
	private static ?Kernel $instance = null;

	private ProfilerInterface $profiler;
	private ContainerInterface $container;
	private string $replicaId = '';

	private string $serverTimezone;
	/** @var null|callable */
	private $errorHandler;
	/** @var null|callable */
	private $exceptionHandler;

	/** @var array<ServiceLoader> */
	private array $serviceLoaders = [];

	private function __construct(
		private readonly Mode $mode,
		private readonly Environment $environment,
	) {}

	/**
	 * @throws KernelTwiceCallException
	 */
	public static function prepare(Mode $mode, Environment $environment): self
	{
		if (!is_null(self::$instance)) {
			throw new KernelTwiceCallException();
		}

		return self::$instance = new self($mode, $environment);
	}

	public static function getInstance(): ?self
	{
		return self::$instance;
	}

	public function run(): void
	{
		if (!empty($this->serverTimezone)) {
			date_default_timezone_set($this->serverTimezone);
		}

		if (!$this->errorHandler) {
			set_error_handler($this->errorHandler);
		}

		if (!$this->exceptionHandler) {
			set_exception_handler($this->exceptionHandler);
		}

		if ($this->isInTestMode() || $this->isInDebugEnv()) {
			$this->enableDisplayErrors();
		}

		require_once Path::getCoreDir() . '/helpers.php';

		$this->container = new Container();

		foreach ($this->serviceLoaders as $serviceLoader) {
			(new $serviceLoader())->load($this->container);
		}

		// @phpstan-ignore assign.propertyType
		$this->profiler = resolve(ProfilerInterface::class);
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

	public function getReplicaId(): string
	{
		return $this->replicaId;
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

	/**
	 * @param array<ServiceLoader> $serviceLoaders
	 */
	public function setServiceLoaders(array $serviceLoaders): static
	{
		$this->serviceLoaders = $serviceLoaders;

		return $this;
	}

	public function setReplicaId(string $replicaId): static
	{
		$this->replicaId = $replicaId;

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
