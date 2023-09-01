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

	public function test_slug_function_works_properly()
	{
		$string = new Str('Hello World');
		$this->assertEquals('hello-world', $string->slug());

		$string = new Str('HelloWorld');
		$this->assertEquals('hello-world', $string->slug());

		$string = new Str('hello_world');
		$this->assertEquals('hello-world', $string->slug());

		$string = new Str('Something');
		$this->assertEquals('something', $string->slug());

		$string = new Str('hello-world');
		$this->assertEquals('hello-world', $string->slug());

		$string = new Str('!@#$%^&*()');
		$this->assertEquals('', $string->slug());

		$string = new Str('I ♥️ Emoji');
		$this->assertEquals('i-emoji', $string->slug());

		$string = new Str('?eHE_llo-worlD!?');
		$this->assertEquals('e-he-llo-worl-d', $string->slug());
	}

	public function test_camel_case_function_works_properly()
	{
		$string = new Str('Hello World');
		$this->assertEquals('helloWorld', $string->camelCase());

		$string = new Str('HelloWorld');
		$this->assertEquals('helloWorld', $string->camelCase());

		$string = new Str('Something');
		$this->assertEquals('something', $string->camelCase());
	}
}
