<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\PHPStan;

use PHPStan\Testing\RuleTestCase;
use Sakoo\Framework\Core\Tests\Bootstrap;

abstract class PHPStanTestCase extends RuleTestCase
{
	use Bootstrap;
}
