<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

class VirtualMethodObject implements MethodInterface
{
	private bool $isStatic = false;
	private ?string $returnType = null;
	private string $methodName = '';
	private ?string $description = null;
	private array $params = [];

	public function __construct(private string $line)
	{
		$this->parse();
	}

	private function parse(): void
	{
		$this->line = trim(substr($this->line, strlen('@method')));

		if (str_starts_with($this->line, 'static ')) {
			$this->isStatic = true;
			$this->line = trim(substr($this->line, strlen('static')));
		}

		$parts = explode(' ', $this->line, 2);

		if (2 === count($parts) && $this->isTypeLike($parts[0])) {
			$this->returnType = $parts[0];
			$this->line = trim($parts[1]);
		}

		$parenPos = strpos($this->line, '(');

		throwUnless($parenPos, new VirtualMethodDeclerationException());

		$this->methodName = trim(substr($this->line, 0, $parenPos));
		$afterParen = substr($this->line, $parenPos + 1);

		$closeParenPos = strpos($afterParen, ')');
		$paramSection = substr($afterParen, 0, $closeParenPos);
		$this->description = trim(substr($afterParen, $closeParenPos + 1)) ?: null;
		$this->params = $this->parseParams($paramSection);
	}

	/**
	 * Parse parameters from a "(...)" section manually.
	 */
	private function parseParams(string $paramSection): array
	{
		$params = [];

		$rawParams = array_filter(array_map('trim', explode(',', $paramSection)));

		foreach ($rawParams as $param) {
			$type = null;
			$name = null;
			$default = null;

			$tokens = preg_split('/\s+/', $param);

			foreach ($tokens as $token) {
				// نام پارامتر
				if ('$' === $token[0]) {
					$name = ltrim($token, '$');
				}
				// مقدار پیش‌فرض
				elseif (str_contains($token, '=')) {
					[$before, $after] = explode('=', $token, 2);
					$default = trim($after);

					if ($this->isTypeLike($before)) {
						$type = $before;
					}
				}
				// نوع پارامتر
				elseif ($this->isTypeLike($token)) {
					$type = $token;
				}
			}

			if ($name || $type || $default) {
				$params[] = [
					'type' => $type,
					'name' => $name,
					'default' => $default,
				];
			}
		}

		return $params;
	}

	/**
	 * یک بررسی ساده برای اینکه توکن شبیه نوع (type) هست یا نه.
	 */
	private function isTypeLike(string $token): bool
	{
		$token = trim($token, '?[]\\');

		return ctype_alpha($token[0] ?? '');
	}

	public function getClass(): ClassObject
	{
		// TODO: Implement getClass() method.
	}

	public function getMethodParameters(): array
	{
		// TODO: Implement getMethodParameters() method.
	}

	public function getName(): string
	{
		// TODO: Implement getName() method.
	}

	public function isPrivate(): bool
	{
		// TODO: Implement isPrivate() method.
	}

	public function isProtected(): bool
	{
		// TODO: Implement isProtected() method.
	}

	public function isPublic(): bool
	{
		// TODO: Implement isPublic() method.
	}

	public function isStatic(): bool
	{
		// TODO: Implement isStatic() method.
	}

	public function isConstructor(): bool
	{
		// TODO: Implement isConstructor() method.
	}

	public function isMagicMethod(): bool
	{
		// TODO: Implement isMagicMethod() method.
	}

	public function getMethodReturnTypes(): string
	{
		// TODO: Implement getMethodReturnTypes() method.
	}

	public function getPhpDocs(): array
	{
		// TODO: Implement getPhpDocs() method.
	}

	public function getModifiers(): array
	{
		// TODO: Implement getModifiers() method.
	}

	public function isFrameworkFunction(): bool
	{
		// TODO: Implement isFrameworkFunction() method.
	}

	public function getDefaultValues(): string
	{
		// TODO: Implement getDefaultValues() method.
	}

	public function getDefaultValueTypes(): string
	{
		// TODO: Implement getDefaultValueTypes() method.
	}

	public function shouldNotDocument(): bool
	{
		// TODO: Implement shouldNotDocument() method.
	}

	public function isStaticInstantiator(): bool
	{
		// TODO: Implement isStaticInstantiator() method.
	}
}
