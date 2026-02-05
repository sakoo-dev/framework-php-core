<?php

class TestClass
{
	// Should trigger error - unused private method
	private function unusedMethod(): void
	{
		// This method is never called
	}

	// Should trigger error - another unused private method
	private function anotherUnusedMethod(): string
	{
		return 'test';
	}

	// Should NOT trigger error - used private method
	private function usedMethod(): void
	{
		echo 'used';
	}

	// Should NOT trigger error - public method
	public function publicMethod(): void
	{
		$this->usedMethod(); // Uses private method
	}

	// Should NOT trigger error - protected method
	protected function protectedMethod(): void
	{
		// Protected methods are not checked
	}

	// Should NOT trigger error - magic method
	private function __sleep()
	{
		// Magic methods are excluded
	}

	// Should NOT trigger error - used in static call
	private static function staticUsedMethod(): void
	{
		echo 'static used';
	}

	public function callStatic(): void
	{
		self::staticUsedMethod();
	}
}

class AnotherClass
{
	// Should trigger error - unused in different class
	private function orphanMethod(): void
	{
		// Unused in this class
	}

	// Should NOT trigger error - used method
	private function usedInSameClass(): void
	{
		echo 'used here';
	}

	public function caller(): void
	{
		$this->usedInSameClass();
	}
}

// Usage outside classes
$test = new TestClass();
$test->publicMethod();

$another = new AnotherClass();
$another->caller();
