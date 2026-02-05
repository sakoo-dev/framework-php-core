<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

class VirtualMethodObject implements MethodInterface
{
	private bool $isStatic = false;
	private ?string $returnType = null;
	private string $methodName = '';
	private ?string $description = null;
	/** @var array<array<string, null|string>> */
	private array $params = [];

	/**
	 * @throws InvalidVirtualMethodDefinitionException
	 */
	public function __construct(private ClassObject $classObject, private string $line)
	{
		$this->parse();
	}

	public function getClass(): ClassObject
	{
		return $this->classObject;
	}

	public function getName(): string
	{
		return $this->methodName;
	}

	public function isPrivate(): bool
	{
		return false;
	}

	public function isProtected(): bool
	{
		return false;
	}

	public function isPublic(): bool
	{
		return true;
	}

	public function isStatic(): bool
	{
		return $this->isStatic;
	}

	public function isConstructor(): bool
	{
		return '__construct' === $this->methodName;
	}

	public function isMagicMethod(): bool
	{
		return str_starts_with($this->methodName, '__');
	}

	public function getMethodReturnTypes(): ?string
	{
		return $this->returnType;
	}

	/**
	 * @return array<string, mixed>
	 */
	public function getPhpDocs(): array
	{
		return [
			'description' => $this->description,
			'params' => $this->params,
			'return' => $this->returnType,
		];
	}

	public function getModifiers(): array
	{
		$modifiers = ['public'];

		if ($this->isStatic) {
			$modifiers[] = 'static';
		}

		return $modifiers;
	}

	public function isFrameworkFunction(): bool
	{
		return false;
	}

	public function getDefaultValues(): string
	{
		$defaults = array_filter(array_column($this->params, 'default'));

		return implode(', ', $defaults);
	}

	public function getDefaultValueTypes(): string
	{
		$types = array_filter(array_column($this->params, 'type'));

		return implode('|', $types);
	}

	public function shouldNotDocument(): bool
	{
		return str_contains($this->description ?? '', '@internal');
	}

	public function isStaticInstantiator(): bool
	{
		return $this->isStatic()
			&& $this->isPublic()
			&& in_array($this->getMethodReturnTypes(), ['self', 'static', $this->getName()], true);
	}

	/**
	 * @throws InvalidVirtualMethodDefinitionException
	 */
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

		throwIf(false === $parenPos, new InvalidVirtualMethodDefinitionException());

		$afterParen = substr($this->line, $parenPos + 1);
		$closeParenPos = strpos($afterParen, ')');

		throwIf(false === $closeParenPos, new InvalidVirtualMethodDefinitionException());

		// @phpstan-ignore argument.type
		$paramSection = substr($afterParen, 0, $closeParenPos);
		// @phpstan-ignore argument.type
		$this->methodName = trim(substr($this->line, 0, $parenPos));
		$this->description = trim(substr($afterParen, $closeParenPos + 1)) ?: null;
		$this->params = $this->parseParams($paramSection);
	}

	/**
	 * @return array<array<string, null|string>>
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

			if ($tokens) {
				foreach ($tokens as $token) {
					if (str_starts_with($token, '$')) {
						$name = ltrim($token, '$');
					} elseif (str_contains($token, '=')) {
						[$before, $after] = explode('=', $token, 2);
						$default = trim($after);

						if ($this->isTypeLike($before)) {
							$type = trim($before);
						}
					} elseif ($this->isTypeLike($token)) {
						$type = $token;
					}
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

	private function isTypeLike(string $token): bool
	{
		$token = trim($token, '?[]\\');

		return ctype_alpha($token[0] ?? '');
	}
}
