<?php

namespace Sakoo\Framework\Core\Tests;

use Sakoo\Framework\Core\Env\Env;
use Sakoo\Framework\Core\Handler\ErrorHandler;
use Sakoo\Framework\Core\Handler\ExceptionHandler;
use Sakoo\Framework\Core\Kernel\Environment;
use Sakoo\Framework\Core\Kernel\Kernel;
use Sakoo\Framework\Core\Kernel\Mode;
use Sakoo\Framework\Core\Path\Path;

trait RunKernel
{
	public static function runKernel(): void
	{
		Env::load(Path::getRootDir() . '/.env');

		$loaders = require_once Path::getCoreDir() . '/ServiceLoader/Loaders.php';
		$timeZone = Env::get('SERVER_TIME_ZONE', 'Asia/Tehran');

		Kernel::prepare(Mode::Test, Environment::Debug)
			->setErrorHandler(new ErrorHandler())
			->setExceptionHandler(new ExceptionHandler())
			->setServerTimezone($timeZone)
			->setServiceLoaders($loaders)
			->run();
	}
}
