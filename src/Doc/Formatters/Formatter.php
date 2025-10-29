<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Formatters;

use Sakoo\Framework\Core\Markup\Markup;

abstract class Formatter
{
	public function __construct(protected Markup $markup) {}

	abstract public function format(array $namespaces): string;
}
