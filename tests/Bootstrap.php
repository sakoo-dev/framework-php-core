<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests;

use Sakoo\Framework\Core\Env\Env;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Handler\ErrorHandler;
use Sakoo\Framework\Core\Handler\ExceptionHandler;
use Sakoo\Framework\Core\Kernel\Environment;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Kernel\Mode;
use Sakoo\Framework\Core\Path\Path;

trait Bootstrap
{
	public static function runKernel(): void
	{
		$envFile = File::open(Disk::Local, Path::getRootDir() . '/.env');
		Env::load($envFile);

		$loaders = require_once Path::getCoreDir() . '/ServiceLoader/Loaders.php';
		$timeZone = Env::get('SERVER_TIME_ZONE', 'UTC');

		Kernel::prepare(Mode::Test, Environment::Debug)
			->setErrorHandler(new ErrorHandler())
			->setExceptionHandler(new ExceptionHandler())
			->setServiceLoaders($loaders)
			->setServerTimezone($timeZone)
			->run();
	}
}
