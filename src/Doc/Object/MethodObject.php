<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

use Sakoo\Framework\Core\Doc\Attributes\DontDocument;
use Sakoo\Framework\Core\Regex\Regex;

readonly class MethodObject
{
	public function __construct(private \ReflectionMethod $method) {}

	public function getMethodParameters(): array
	{
		$parameters = [];

		foreach ($this->method->getParameters() as $parameter) {
			$parameters[] = new ParameterObject($parameter);
		}

		return $parameters;
	}

	public function getName(): string
	{
		return $this->method->getName();
	}

	public function isPrivate(): bool
	{
		return $this->method->isPrivate();
	}

	public function isProtected(): bool
	{
		return $this->method->isProtected();
	}

	public function isPublic(): bool
	{
		return $this->method->isPublic();
	}

	public function isStatic(): bool
	{
		return $this->method->isStatic();
	}

	public function isConstructor(): bool
	{
		return $this->method->isConstructor();
	}

	public function isMagicMethod(): bool
	{
		return str_starts_with($this->method->getName(), '__');
	}

	public function getMethodReturnTypes(): string
	{
		$type = new TypeObject($this->method->getReturnType());

		return $type->getName();
	}

	public function getPhpDocs(): string
	{
		$phpDoc = $this->method->getDocComment();

		if (!$phpDoc) {
			return '';
		}

		$match = Regex::make()
			->startsWith('/**')
			->add('([\s\S]*)')
			->endsWith('*/')
			->match($phpDoc);

		return $match ? $match[1] : '';
	}

	public function getModifiers(): array
	{
		return \Reflection::getModifierNames($this->method->getModifiers());
	}

	public function isFrameworkFunction(): bool
	{
		return str_starts_with($this->method->class, 'Sakoo\Framework\Core');
	}

	public function getDefaultValues(): string
	{
		return implode(', ', array_map(fn (ParameterObject $item) => '$' . $item->getName(), $this->getMethodParameters()));
	}

	public function getDefaultValueTypes(): string
	{
		return implode(', ', array_map(function (ParameterObject $item): string {
			$result = '';

			if ($type = $item->getType()) {
				$result .= $type->getName() . ' ';
			}

			$result .= '$' . $item->getName();

			return $result;
		}, $this->getMethodParameters()));
	}

	public function shouldNotDocument(): bool
	{
		return !empty($this->method->getAttributes(DontDocument::class));
	}
}
