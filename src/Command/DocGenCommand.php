<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Doc\Doc;
use Sakoo\Framework\Core\Doc\Formatters\DocFormatter;
use Sakoo\Framework\Core\Doc\Formatters\Formatter;
use Sakoo\Framework\Core\Doc\Formatters\TocFormatter;
use Sakoo\Framework\Core\Doc\Sorter\NamespaceSorter;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Finder\SplFileObject;
use Sakoo\Framework\Core\Path\Path;

class DocGenCommand extends Command
{
	public static function getName(): string
	{
		return 'doc:gen';
	}

	public static function getDescription(): string
	{
		return 'Generates Document of Framework';
	}

	public function run(Input $input, Output $output): int
	{
		$output->block('Generating ...', style: Output::COLOR_CYAN);

		/**
		 * @var array<SplFileObject> $finder
		 *
		 * @phpstan-ignore argument.type
		 */
		$finder = Path::getPHPFilesOf($input->getArgument(1) ?? Path::getCoreDir());
		$sorter = new NamespaceSorter();

		/** @var Formatter $formatter */
		$formatter = resolve(DocFormatter::class);
		$docFile = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/Home.md');
		(new Doc($finder, $formatter, $sorter, $docFile))->generate();

		/** @var Formatter $tocFormatter */
		$tocFormatter = resolve(TocFormatter::class);
		$wikiSideBar = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/_Sidebar.md');
		(new Doc($finder, $tocFormatter, $sorter, $wikiSideBar))->generate();

		$wikiFooter = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/_Footer.md');
		$wikiFooter->write('Powered by Sakoo Development Group - ' . date('Y'));

		$output->block('Document has been Generated Successfully!', Output::COLOR_GREEN);

		return Output::SUCCESS;
	}
}
