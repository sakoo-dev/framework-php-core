<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Assert;

/**
 * @method AssertionChain bool(mixed $value)
 */
class AssertionChain
{
	public function __construct(private mixed $value = null)
	{
	}

	public function __call(string $name, array $arguments)
	{
		array_unshift($arguments, $this->value);
		call_user_func_array([Assert::class, $name], $arguments);

		return $this;
	}
}
