<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

class ApplicationTester
{
	private string $output = '';
	private int $statusCode = 0;

	public function __construct(private readonly Application $application) {}

	public function run(array $input, array $options = []): int
	{
		ob_start();
		$this->statusCode = $this->application->run($input, $options);
		$this->output = ob_get_clean() ?: '';

		return $this->statusCode;
	}

	public function assertCommandIsSuccessful(): void
	{
		if (0 !== $this->statusCode) {
			throw new \RuntimeException('Command did not execute successfully.');
		}
	}

	public function getDisplay(): string
	{
		return $this->output;
	}
}
