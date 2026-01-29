<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Doc\Object;

interface MethodInterface
{
	public function getClass(): ClassObject;

	public function getName(): string;

	public function isPrivate(): bool;

	public function isProtected(): bool;

	public function isPublic(): bool;

	public function isStatic(): bool;

	public function isConstructor(): bool;

	public function isMagicMethod(): bool;

	public function getMethodReturnTypes(): ?string;

	/** @return string[] */
	public function getPhpDocs(): array;

	/** @return string[] */
	public function getModifiers(): array;

	public function isFrameworkFunction(): bool;

	public function getDefaultValues(): string;

	public function getDefaultValueTypes(): string;

	public function shouldNotDocument(): bool;

	public function isStaticInstantiator(): bool;
}
