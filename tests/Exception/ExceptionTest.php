<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Exception;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Exception\Exception;
use Sakoo\Framework\Core\Tests\TestCase;

final class ExceptionTest extends TestCase
{
	#[Test]
	public function it_is_subclass_of_exception(): void
	{
		$this->assertInstanceOf(\Exception::class, new Exception());
	}
}
