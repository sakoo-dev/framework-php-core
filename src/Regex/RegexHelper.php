<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Regex;

class RegexHelper
{
	public static function findCamelCase(): Regex
	{
		return Regex::make()
			->lookbehind(fn (Regex $exp) => $exp->add('[' . Regex::ALPHABET_LOWER . ']'))
			->lookahead(fn (Regex $exp) => $exp->add('[' . Regex::ALPHABET_UPPER . ']'));
	}

	public static function getSpaceBetweenWords(): Regex
	{
		return Regex::make()
			->lookbehind(fn (Regex $exp) => $exp->word())
			->space()
			->lookahead(fn (Regex $exp) => $exp->word());
	}

	public static function getSpecialChars(): Regex
	{
		return Regex::make()
			->somethingWithout(
				fn (Regex $exp) => $exp->add(Regex::ALPHABET_LOWER . Regex::ALPHABET_UPPER . Regex::DIGITS)
			);
	}
}
