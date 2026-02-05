<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Regex;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Regex\RegexHelper;
use Sakoo\Framework\Core\Tests\TestCase;

final class RegexHelperTest extends TestCase
{
	#[Test]
	public function find_camel_case_function(): void
	{
		$this->assertEquals('(?<=[a-z])(?=[A-Z])', RegexHelper::findCamelCase());
	}

	#[Test]
	public function get_special_chars_function(): void
	{
		$this->assertEquals('[^a-zA-Z0-9]+', RegexHelper::getSpecialChars());
	}

	#[Test]
	public function get_space_between_words_function(): void
	{
		$this->assertEquals('(?<=\w)\s(?=\w)', RegexHelper::getSpaceBetweenWords());
	}
}
