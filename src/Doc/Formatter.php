<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc;

interface Formatter
{
	public function format(array $data): string;
}
