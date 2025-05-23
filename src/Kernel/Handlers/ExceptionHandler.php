<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Kernel\Handlers;

class ExceptionHandler
{
	/**
	 * @throws \Throwable
	 */
	public function __invoke(\Throwable $exception): never
	{
		throw $exception;
	}
}
