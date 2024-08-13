<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Set;

use Sakoo\Framework\Core\Set\Set;
use Sakoo\Framework\Core\Tests\TestCase;

final class SetAccessTest extends TestCase
{
	private Set $numbers;

	protected function setUp(): void
	{
		parent::setUp();
		$this->numbers = set(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J']);
	}

	public function test_it_can_get_first_set_item()
	{
		$this->assertEquals('A', $this->numbers->first());
	}

	public function test_it_can_get_second_set_item()
	{
		$this->assertEquals('B', $this->numbers->second());
	}

	public function test_it_can_get_third_set_item()
	{
		$this->assertEquals('C', $this->numbers->third());
	}

	public function test_it_can_get_fourth_set_item()
	{
		$this->assertEquals('D', $this->numbers->fourth());
	}

	public function test_it_can_get_fifth_set_item()
	{
		$this->assertEquals('E', $this->numbers->fifth());
	}

	public function test_it_can_get_sixth_set_item()
	{
		$this->assertEquals('F', $this->numbers->sixth());
	}

	public function test_it_can_get_seventh_set_item()
	{
		$this->assertEquals('G', $this->numbers->seventh());
	}

	public function test_it_can_get_eighth_set_item()
	{
		$this->assertEquals('H', $this->numbers->eighth());
	}

	public function test_it_can_get_ninth_set_item()
	{
		$this->assertEquals('I', $this->numbers->ninth());
	}

	public function test_it_can_get_tenth_set_item()
	{
		$this->assertEquals('J', $this->numbers->tenth());
	}
}
