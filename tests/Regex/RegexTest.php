<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Regex;

use Sakoo\Framework\Core\Regex\Regex;
use Sakoo\Framework\Core\Tests\TestCase;

final class RegexTest extends TestCase
{
	public function test_regex_start_of_line_works_properly()
	{
		$this->assertEquals('^', Regex::make()->startOfLine());
	}

	public function test_regex_starts_with_works_properly()
	{
		$this->assertEquals('^\/', Regex::make()->startsWith('/'));
		$this->assertEquals('^/', Regex::make()->startsWith(fn (Regex $exp) => $exp->add('/')));
	}

	public function test_regex_end_of_line_works_properly()
	{
		$this->assertEquals('$', Regex::make()->endOfLine());
	}

	public function test_regex_ends_with_works_properly()
	{
		$this->assertEquals('\/$', Regex::make()->endsWith('/'));
		$this->assertEquals('/$', Regex::make()->endsWith(fn (Regex $exp) => $exp->add('/')));
	}

	public function test_regex_anything_works_properly()
	{
		$this->assertEquals('.*', Regex::make()->anything());
	}

	public function test_regex_something_works_properly()
	{
		$this->assertEquals('.+', Regex::make()->something());
	}

	public function test_regex_something_with_works_properly()
	{
		$this->assertEquals('[ABC]+', Regex::make()->somethingWith('ABC'));
		$this->assertEquals('[XYZ]+', Regex::make()->somethingWith(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_anything_with_works_properly()
	{
		$this->assertEquals('[ABC]*', Regex::make()->anythingWith('ABC'));
		$this->assertEquals('[XYZ]*', Regex::make()->anythingWith(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_something_without_works_properly()
	{
		$this->assertEquals('[^ABC]+', Regex::make()->somethingWithout('ABC'));
		$this->assertEquals('[^XYZ]+', Regex::make()->somethingWithout(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_anything_without_works_properly()
	{
		$this->assertEquals('[^ABC]*', Regex::make()->anythingWithout('ABC'));
		$this->assertEquals('[^XYZ]*', Regex::make()->anythingWithout(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_wrap_works_properly()
	{
		$this->assertEquals('(\.)', Regex::make()->wrap('.'));
		$this->assertEquals('(?:\.)', Regex::make()->wrap('.', true));

		$this->assertEquals('(ABC)', Regex::make()->wrap(fn (Regex $exp) => $exp->add('ABC')));
		$this->assertEquals('(?:ABC)', Regex::make()->wrap(fn (Regex $exp) => $exp->add('ABC'), true));
	}

	public function test_regex_bracket_works_properly()
	{
		$this->assertEquals('[ABC]', Regex::make()->bracket('ABC'));
		$this->assertEquals('[XYZ]', Regex::make()->bracket(fn (Regex $exp) => $exp->add('XYZ')));
	}

	/** @dataProvider specialCharProvider */
	public function test_regex_add_works_properly($char)
	{
		$this->assertEquals("\\$char", Regex::make()->safeAdd($char));
		$this->assertEquals($char, Regex::make()->add($char));
	}

	public function test_regex_shorthands_work_properly()
	{
		$this->assertEquals('\r\n', Regex::make()->windowsLineBreak());
		$this->assertEquals('\n', Regex::make()->unixLineBreak());
		$this->assertEquals('\t', Regex::make()->tab());
		$this->assertEquals('\s', Regex::make()->space());
		$this->assertEquals('\w', Regex::make()->word());
	}

	public function test_regex_maybe_works_properly()
	{
		$this->assertEquals('A?', Regex::make()->maybe('A'));
	}

	public function test_regex_one_of_works_properly()
	{
		$this->assertEquals('(?:A|B|C)', Regex::make()->oneOf(['A', 'B', 'C']));
	}

	public function test_regex_digit_works_properly()
	{
		$this->assertEquals('\d{3}', Regex::make()->digit(3));
	}

	public function test_regex_chars_works_properly()
	{
		$this->assertEquals('A-Z', Regex::make()->chars(Regex::ALPHABET_UPPER));
		$this->assertEquals('A-Za-z', Regex::make()->chars(Regex::ALPHABET_UPPER, Regex::ALPHABET_LOWER));
		$this->assertEquals('A-Za-z0-9', Regex::make()->chars(Regex::ALPHABET_UPPER, Regex::ALPHABET_LOWER, Regex::DIGITS));
	}

	/** @dataProvider specialCharProvider */
	public function test_regex_escape_chars_works_properly($char)
	{
		$this->assertEquals("\\$char", Regex::make()->escapeChars($char));
	}

	public function test_regex_lookahead_work_properly()
	{
		$this->assertEquals('(?=ABC)', Regex::make()->lookahead('ABC'));
		$this->assertEquals('(?=XYZ)', Regex::make()->lookahead(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_lookbehind_work_properly()
	{
		$this->assertEquals('(?<=ABC)', Regex::make()->lookbehind('ABC'));
		$this->assertEquals('(?<=XYZ)', Regex::make()->lookbehind(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_negative_lookahead_work_properly()
	{
		$this->assertEquals('(?!ABC)', Regex::make()->negativeLookahead('ABC'));
		$this->assertEquals('(?!XYZ)', Regex::make()->negativeLookahead(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_regex_negative_lookbehind_work_properly()
	{
		$this->assertEquals('(?<!ABC)', Regex::make()->negativeLookbehind('ABC'));
		$this->assertEquals('(?<!XYZ)', Regex::make()->negativeLookbehind(fn (Regex $exp) => $exp->add('XYZ')));
	}

	public function test_it_can_test_matching_expression()
	{
		$regex = Regex::make()
			->startOfLine()
			->startsWith('A')
			->something()
			->endOfLine();

		$this->assertTrue($regex->test('Anything'));
		$this->assertTrue($regex->test('All'));

		$this->assertFalse($regex->test('Everything'));
	}

	public function test_it_can_replace_matching_expression()
	{
		$regex = Regex::make()
			->startsWith('L')
			->something()
			->endsWith('up');

		$this->assertEquals('Replaced', $regex->replace('Lookup', 'Replaced'));
		$this->assertNotEquals('Replaced', $regex->replace('Pickup', 'Replaced'));
	}

	public function test_it_can_split_matching_expression()
	{
		$regex = Regex::make()
			->lookahead(fn (Regex $exp) => $exp->add('[' . Regex::ALPHABET_UPPER . ']'))
			->lookbehind(fn (Regex $exp) => $exp->add('[' . Regex::ALPHABET_LOWER . ']'));

		$this->assertEquals(['Hello', 'World'], $regex->split('HelloWorld'));
		$this->assertEquals(['test'], $regex->split('test'));
	}

	public function test_it_can_find_matching_expression()
	{
		$regex = Regex::make()
			->somethingWith(fn (Regex $exp) => $exp->digit());

		$text = '123 Hello 456 World';

		$this->assertEquals(['123'], $regex->match($text));
		$this->assertEquals(['123', '456'], $regex->matchAll($text)[0]);
	}

	public function specialCharProvider()
	{
		yield ['.'];
		yield ['^'];
		yield ['$'];
		yield ['*'];
		yield ['+'];
		yield ['?'];
		yield ['|'];
		yield ['['];
		yield [']'];
		yield ['('];
		yield [']'];
		yield ['\\'];
		yield ['{'];
		yield [']'];
	}
}
