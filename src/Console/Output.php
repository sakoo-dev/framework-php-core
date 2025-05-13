<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console;

class Output
{
	final public const int SUCCESS = 0;
	final public const int ERROR = 1;

	final public const int STYLE_NORMAL = 0;
	final public const int STYLE_BOLD = 1;
	final public const int STYLE_UNDERLINE = 4;
	final public const int STYLE_BLINK = 5;
	final public const int STYLE_REVERSE = 7;

	final public const int COLOR_BLACK = 30;
	final public const int COLOR_RED = 31;
	final public const int COLOR_GREEN = 32;
	final public const int COLOR_YELLOW = 33;
	final public const int COLOR_BLUE = 34;
	final public const int COLOR_MAGENTA = 35;
	final public const int COLOR_CYAN = 36;
	final public const int COLOR_WHITE = 37;

	final public const int BG_BLACK = 40;
	final public const int BG_RED = 41;
	final public const int BG_GREEN = 42;
	final public const int BG_YELLOW = 43;
	final public const int BG_BLUE = 44;
	final public const int BG_MAGENTA = 45;
	final public const int BG_CYAN = 46;
	final public const int BG_WHITE = 47;

	private bool $supportsColors = false;
	/** @var list<string> */
	private array $buffer = [];
	private bool $isSilentMode = false;

	public function __construct(bool $forceColors = false)
	{
		$this->supportsColors = $forceColors || $this->detectColorSupport();
	}

	private function detectColorSupport(): bool
	{
		if (DIRECTORY_SEPARATOR === '\\') {
			return false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI') || 'xterm' === getenv('TERM') || 'Hyper' === getenv('TERM_PROGRAM');
		}

		if (function_exists('posix_isatty')) {
			return posix_isatty(STDOUT);
		}

		return getenv('GITHUB_ACTIONS') || getenv('GITLAB_CI') || getenv('TRAVIS') || getenv('CIRCLECI') || getenv('JENKINS_URL') || getenv('CI');
	}

	public function newLine(): void
	{
		$this->text(PHP_EOL . PHP_EOL);
	}

	/**
	 * @param list<string>|string $message
	 */
	public function text(array|string $message, ?int $foreground = null, ?int $background = null, ?int $style = null): void
	{
		$text = $this->formatText($message, $foreground, $background, $style);

		echo !$this->isSilentMode ? $text : '';
	}

	/**
	 * @param list<string>|string $message
	 */
	public function block(array|string $message, ?int $foreground = null, ?int $background = null, ?int $style = null): void
	{
		$text = $this->formatText($message, $foreground, $background, $style);

		echo !$this->isSilentMode ? ($text . PHP_EOL) : '';
	}

	/**
	 * @param list<string>|string $message
	 */
	public function success(array|string $message): void
	{
		$this->block($message, self::COLOR_GREEN, null, self::STYLE_BOLD);
	}

	/**
	 * @param list<string>|string $message
	 */
	public function info(array|string $message): void
	{
		$this->block($message, self::COLOR_BLUE, null, self::STYLE_BOLD);
	}

	/**
	 * @param list<string>|string $message
	 */
	public function warning(array|string $message): void
	{
		$this->block($message, self::COLOR_YELLOW, null, self::STYLE_BOLD);
	}

	/**
	 * @param list<string>|string $message
	 */
	public function error(array|string $message): void
	{
		$this->block($message, self::COLOR_RED, null, self::STYLE_BOLD);
	}

	public function setSilentMode(bool $isSilentMode): void
	{
		$this->isSilentMode = $isSilentMode;
	}

	public function supportsColors(): bool
	{
		return $this->supportsColors;
	}

	/** @return list<string> */
	public function getBuffer(): array
	{
		return $this->buffer;
	}

	public function getDisplay(): string
	{
		return implode('', $this->getBuffer());
	}

	/**
	 * @param list<string>|string $message
	 */
	private function formatText(array|string $message, ?int $foreground = null, ?int $background = null, ?int $style = null): string
	{
		if (is_array($message)) {
			$message = implode(PHP_EOL, $message);
		}

		if (!$this->supportsColors()) {
			$this->buffer[] = $message;

			return $message;
		}

		$format = [];

		if (!empty($style)) {
			$format[] = $style;
		}

		if (!empty($foreground)) {
			$format[] = $foreground;
		}

		if (!empty($background)) {
			$format[] = $background;
		}

		if (empty($format)) {
			$this->buffer[] = $message;

			return $message;
		}

		$message = sprintf("\033[%sm%s\033[0m", implode(';', $format), $message);
		$this->buffer[] = $message;

		return $message;
	}
}
