<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing\Traits;

trait FileAssertions
{
	protected static function assertIsExecutable(string $filename, string $message = ''): void
	{
		$message = $message ?: "Failed asserting that $filename is executable";
		static::assertThat(is_executable($filename), static::isTrue(), $message);
	}

	protected static function assertIsNotExecutable(string $filename, string $message = ''): void
	{
		$message = $message ?: "Failed asserting that $filename is not executable";
		static::assertThat(is_executable($filename), static::isFalse(), $message);
	}
}
