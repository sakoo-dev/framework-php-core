<?php

namespace Sakoo\Framework\Core\Tests\Env;

use Sakoo\Framework\Core\Env\Env;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

class EnvTest extends TestCase
{
	private string $dotEnvPath;

	protected function setUp(): void
	{
		parent::setUp();
		$this->dotEnvPath = Path::getStorageDir() . '/tests/env/.env';
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		$this->removeEnvVariables('FOO', 'BAR', 'BAZ');
	}

	public function test_it_can_get_from_env()
	{
		$this->assertNull(Env::get('FOO'));

		putenv('FOO=BAR');

		$this->assertEquals('BAR', Env::get('FOO'));
	}

	public function test_it_can_return_default_when_key_not_exists()
	{
		$this->assertEquals('BAZ', Env::get('FOO', 'BAZ'));

		putenv('FOO=BAR');

		$this->assertEquals('BAR', Env::get('FOO', 'BAZ'));
	}

	public function test_it_can_load_configs_from_file()
	{
		$content = "\n\n FOO=VALUE1 \n BAR=VALUE2 \n BAZ=VALUE3 \n\n";
		$this->makeDotEnvFile($content);

		$this->assertNull(Env::get('FOO'));
		$this->assertNull(Env::get('BAR'));
		$this->assertNull(Env::get('BAZ'));

		Env::load($this->dotEnvPath);

		$this->assertEquals('VALUE1', Env::get('FOO'));
		$this->assertEquals('VALUE2', Env::get('BAR'));
		$this->assertEquals('VALUE3', Env::get('BAZ'));
	}

	public function test_it_ignore_commented_configs()
	{
		$content = "#FOO=VALUE1 \n # BAR=VALUE2 \n BAZ=VALUE3";
		$this->makeDotEnvFile($content);

		$this->assertNull(Env::get('FOO'));
		$this->assertNull(Env::get('BAR'));
		$this->assertNull(Env::get('BAZ'));

		Env::load($this->dotEnvPath);

		$this->assertNull(Env::get('FOO'));
		$this->assertNull(Env::get('BAR'));
		$this->assertEquals('VALUE3', Env::get('BAZ'));
	}

	public function test_it_handle_mismatch_configs()
	{
		$content = "# \n FOO= \n BAR \n =VALUE3 \n =";
		$this->makeDotEnvFile($content);

		$allEnvVars = getenv();

		Env::load($this->dotEnvPath);

		$allEnvVars['FOO'] = '';
		$this->assertEquals($allEnvVars, getenv());
	}

	private function makeDotEnvFile(string $content)
	{
		File::open(Disk::Local, $this->dotEnvPath)
			->write($content);
	}

	private function removeEnvVariables(...$vars)
	{
		foreach ($vars as $var) {
			putenv($var);
		}
	}
}
