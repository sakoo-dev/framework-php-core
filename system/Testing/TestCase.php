<?php

declare(strict_types=1);

namespace System\Testing;

use Sakoo\Framework\Core\Testing\TestCase as SakooTestCase;

abstract class TestCase extends SakooTestCase
{
	use Bootstrap;
}
