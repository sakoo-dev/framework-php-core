<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing;

use PHPUnit\Framework\TestCase;

class ExceptionAssertion
{
	private ?int $code = null;
	private ?string $type = null;
	private ?string $message = null;

	/**
	 * @param callable $fn
	 */
	public function __construct(private readonly TestCase $phpunit, private $fn) {}

	public function withCode(int $code): static
	{
		$this->code = $code;

		return $this;
	}

	public function withType(string $type): static
	{
		$this->type = $type;

		return $this;
	}

	public function withMessage(string $message): static
	{
		$this->message = $message;

		return $this;
	}

	public function validate(): void
	{
		$raised = false;

		try {
			call_user_func($this->fn);
		} catch (\Exception $exception) {
			$raised = true;

			if (!is_null($this->type)) {
				$this->phpunit::assertTrue(is_a($exception, $this->type));
			}

			if (!is_null($this->message)) {
				$this->phpunit::assertEquals($this->message, $exception->getMessage());
			}

			if (!is_null($this->code)) {
				$this->phpunit::assertEquals($this->code, $exception->getCode());
			}
		} finally {
			$raised ?: $this->phpunit::fail('Error does not raised!');
		}
	}
}
