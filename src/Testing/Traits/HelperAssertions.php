<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Testing\Traits;

use Sakoo\Framework\Core\Testing\ExceptionAssertion;

trait HelperAssertions
{
	protected function throwsException(callable $fn): ExceptionAssertion
	{
		return new ExceptionAssertion($this, $fn);
	}
}
