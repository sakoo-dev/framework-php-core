<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Regex;

use Sakoo\Framework\Core\Regex\RegexHelper;
use Sakoo\Framework\Core\Tests\TestCase;

final class RegexHelperTest extends TestCase
{
	public function test_find_camel_case_function()
	{
		$this->assertEquals('(?<=[a-z])(?=[A-Z])', RegexHelper::findCamelCase());
	}

	public function test_get_special_chars_function()
	{
		$this->assertEquals('[^a-zA-Z0-9]+', RegexHelper::getSpecialChars());
	}

	public function test_get_space_between_words_function()
	{
		$this->assertEquals('(?<=\w)\s(?=\w)', RegexHelper::getSpaceBetweenWords());
	}
}
