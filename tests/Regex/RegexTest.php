<?php

namespace Sakoo\Framework\Core\Tests\Regex;

use Sakoo\Framework\Core\Regex\Regex;
use Sakoo\Framework\Core\Tests\TestCase;

class RegexTest extends TestCase
{
	public function test_it_returns_full_regex_by_get_function()
	{
		$this->assertEquals('^', Regex::make()->startOfLine()->get());
		$this->assertEquals('^A', Regex::make()->startsWith('A')->get());

		$this->assertEquals('$', Regex::make()->endOfLine()->get());
		$this->assertEquals('Z$', Regex::make()->endsWith('Z')->get());

		$this->assertEquals('.*', Regex::make()->anything()->get());
		$this->assertEquals('.+', Regex::make()->something()->get());

		$this->assertEquals('[ABC]+', Regex::make()->somethingWith('ABC')->get());
		$this->assertEquals('[ABC]*', Regex::make()->anythingWith('ABC')->get());
		$this->assertEquals('[^ABC]+', Regex::make()->somethingWithout('ABC')->get());
		$this->assertEquals('[^ABC]*', Regex::make()->anythingWithout('ABC')->get());

		$this->assertEquals('(ABC)', Regex::make()->wrap(fn (Regex $exp) => $exp->append('ABC'))->get());
		$this->assertEquals('(?:ABC)', Regex::make()->wrap(fn (Regex $exp) => $exp->append('ABC'), true)->get());

		$this->assertEquals('[ABC]', Regex::make()->bracket(fn (Regex $exp) => $exp->append('ABC'))->get());

		$this->assertEquals('\/', Regex::make()->append('/')->get());
		$this->assertEquals('/', Regex::make()->add('/')->get());

		$this->assertEquals('\\\\r\\\\n', Regex::make()->windowsLineBreak()->get());
		$this->assertEquals('\\\\n', Regex::make()->unixLineBreak()->get());
		$this->assertEquals('\\\\t', Regex::make()->tab());
		$this->assertEquals('\\\\s', Regex::make()->space());
		$this->assertEquals('\\\\w', Regex::make()->word());

		$this->assertEquals('A?', Regex::make()->maybe('A'));

		$this->assertEquals('(?:A|B|C)', Regex::make()->oneOf(['A', 'B', 'C']));

		$this->assertEquals('\d{3}', Regex::make()->digit(3));

		$this->assertEquals('A-Z', Regex::make()->chars(Regex::ALPHABET_UPPER)->get());
		$this->assertEquals('A-Za-z', Regex::make()->chars(Regex::ALPHABET_UPPER, Regex::ALPHABET_LOWER)->get());
		$this->assertEquals('A-Za-z0-9', Regex::make()->chars(Regex::ALPHABET_UPPER, Regex::ALPHABET_LOWER, Regex::DIGITS)->get());

		$this->assertEquals('', Regex::make()->escapeChars(''));
		$this->assertEquals('\<', Regex::make()->escapeChars('<'));
	}

	public function test_it_can_test_matching_expression()
	{
		$regex = Regex::make()
			->startsWith('09')
			->digit(9)
			->endOfLine();

		$this->assertTrue($regex->test('09123456789'));
		$this->assertFalse($regex->test('01122334455'));
	}

	public function test_it_can_replace_matching_expression()
	{
		$regex = Regex::make()
			->append('<')
			->wrap(fn ($exp) => $exp->maybe('/'))
			->somethingWithout('>')
			->append('>');

		$this->assertEquals('<h2>Hello World</h2>', $regex->replace('<h1>Hello World</h1>', '<$1h2>'));
	}

	public function test_it_can_find_matching_expression()
	{
		$str = <<<'REGEXP'
            test@gmail.com
            foo@dev.net
            icloud.com
            user@yahoo.org
        REGEXP;

		$regex = Regex::make()
			->somethingWith(fn ($exp) => $exp->chars(
				Regex::ALPHABET_UPPER,
				Regex::ALPHABET_LOWER,
				Regex::DIGITS,
				Regex::UNDERLINE,
				Regex::DOT,
			))
			->append('@')
			->oneOf(['gmail', 'yahoo', 'icloud'])
			->append('.')
			->oneOf(['com', 'org', 'net']);

		$this->assertEquals('test@gmail.com', $regex->match($str)[0]);
		$this->assertEqualsCanonicalizing(['test@gmail.com', 'user@yahoo.org'], $regex->matchAll($str)[0]);
	}
}
