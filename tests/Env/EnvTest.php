<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Env;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Env\Env;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\FileSystem\Storage;
use Sakoo\Framework\Core\Path\Path;
use Sakoo\Framework\Core\Tests\TestCase;

final class EnvTest extends TestCase
{
	private Storage $storage;

	protected function setUp(): void
	{
		parent::setUp();
		$path = Path::getTempTestDir() . '/env/.env';
		$this->storage = File::open(Disk::Local, $path);
	}

	protected function tearDown(): void
	{
		parent::tearDown();
		$this->removeEnvVariables('FOO', 'BAR', 'BAZ');
	}

	#[Test]
	public function it_can_get_from_env(): void
	{
		$this->assertNull(Env::get('FOO'));

		putenv('FOO=BAR');

		$this->assertEquals('BAR', Env::get('FOO'));
	}

	#[Test]
	public function it_can_return_default_when_key_not_exists(): void
	{
		$this->assertEquals('BAZ', Env::get('FOO', 'BAZ'));

		putenv('FOO=BAR');

		$this->assertEquals('BAR', Env::get('FOO', 'BAZ'));
	}

	#[Test]
	public function it_can_load_configs_from_file(): void
	{
		$this->storage->write("\n\n FOO=VALUE1 \n BAR=VALUE2 \n BAZ=VALUE3 \n\n");

		$this->assertNull(Env::get('FOO'));
		$this->assertNull(Env::get('BAR'));
		$this->assertNull(Env::get('BAZ'));

		Env::load($this->storage);

		$this->assertEquals('VALUE1', Env::get('FOO'));
		$this->assertEquals('VALUE2', Env::get('BAR'));
		$this->assertEquals('VALUE3', Env::get('BAZ'));
	}

	#[Test]
	public function it_ignore_commented_configs(): void
	{
		$this->storage->write("#FOO=VALUE1 \n # BAR=VALUE2 \n BAZ=VALUE3");

		$this->assertNull(Env::get('FOO'));
		$this->assertNull(Env::get('BAR'));
		$this->assertNull(Env::get('BAZ'));

		Env::load($this->storage);

		$this->assertNull(Env::get('FOO'));
		$this->assertNull(Env::get('BAR'));
		$this->assertEquals('VALUE3', Env::get('BAZ'));
	}

	#[Test]
	public function it_handle_mismatch_configs(): void
	{
		$this->storage->write("# \n FOO= \n BAR \n =VALUE3 \n =");

		$allEnvVars = getenv();

		Env::load($this->storage);

		$allEnvVars['FOO'] = '';
		$this->assertEquals($allEnvVars, getenv());
	}

	private function removeEnvVariables(...$vars): void
	{
		foreach ($vars as $var) {
			putenv($var);
		}
	}
}
