<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Str;

use Sakoo\Framework\Core\Str\Str;
use Sakoo\Framework\Core\Tests\TestCase;

final class StrTest extends TestCase
{
	public function test_length_function_works_properly()
	{
		$string = new Str('');
		$this->assertEquals(0, $string->length());

		$string = new Str('Hello, World!');
		$this->assertEquals(13, $string->length());
	}

	public function test_uppercase_words_function_works_properly()
	{
		$string = new Str('hello, world!');
		$this->assertEquals('Hello, World!', $string->uppercaseWords());
	}

	public function test_uppercase_function_works_properly()
	{
		$string = new Str('Hello, World!');
		$this->assertEquals('HELLO, WORLD!', $string->uppercase());
	}

	public function test_lowercase_function_works_properly()
	{
		$string = new Str('Hello, World!');
		$this->assertEquals('hello, world!', $string->lowercase());
	}

	public function test_upper_first_function_works_properly()
	{
		$string = new Str('hello world');
		$this->assertEquals('Hello world', $string->upperFirst());
	}

	public function test_lower_first_function_works_properly()
	{
		$string = new Str('HELLO WORLD');
		$this->assertEquals('hELLO WORLD', $string->lowerFirst());
	}

	public function test_reverse_function_works_properly()
	{
		$string = new Str('Hello, World!');
		$this->assertEquals('!dlroW ,olleH', $string->reverse());
	}

	public function test_contains_function_works_properly()
	{
		$string = new Str('Hello, World!');
		$this->assertTrue($string->contains('World'));
		$this->assertFalse($string->contains('foo'));
	}

	public function test_replace_function_works_properly()
	{
		$string = new Str('Hello, World!');
		$this->assertEquals('Hi, World!', $string->replace('Hello', 'Hi'));
	}

	public function test_trim_function_works_properly()
	{
		$string = new Str('   Hello, World!   ');
		$this->assertEquals('Hello, World!', $string->trim());
	}

	/** @dataProvider slugTexts */
	public function test_slug_function_works_properly($str, $slug)
	{
		$string = new Str($str);
		$this->assertEquals($slug, $string->slug());
	}

	/** @dataProvider camelCaseTexts */
	public function test_camel_case_function_works_properly($str, $camelCase)
	{
		$string = new Str($str);
		$this->assertEquals($camelCase, $string->camelCase());
	}

	public function slugTexts(): \Generator
	{
		yield ['HELLO WORLD', 'hello-world'];
		yield ['hello world', 'hello-world'];
		yield ['Hello World', 'hello-world'];
		yield ['HelloWorld', 'hello-world'];
		yield ['hello_world', 'hello-world'];
		yield ['Something', 'something'];
		yield ['hello-world', 'hello-world'];
		yield ['!@#$%^&*()', ''];
		yield ['I ♥️ Emoji', 'i-emoji'];
		yield ['?eHE_llo-worlD!?', 'e-he-llo-worl-d'];
	}

	public function camelCaseTexts(): \Generator
	{
		yield ['HELLO WORLD', 'helloWorld'];
		yield ['hello world', 'helloWorld'];
		yield ['Hello World', 'helloWorld'];
		yield ['HelloWorld', 'helloWorld'];
		yield ['hello_world', 'helloWorld'];
		yield ['Something', 'something'];
		yield ['hello-world', 'helloWorld'];
		yield ['!@#$%^&*()', ''];
		yield ['I ♥️ Emoji', 'iEmoji'];
		yield ['?eHE_llo-worlD!?', 'eHeLloWorlD'];
	}
}
