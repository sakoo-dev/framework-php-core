<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use Sakoo\Framework\Core\Console\AsCommand;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Doc\Doc;
use Sakoo\Framework\Core\Doc\Formatters\DocFormatter;
use Sakoo\Framework\Core\Doc\Formatters\TocFormatter;
use Sakoo\Framework\Core\Doc\Sorter\NamespaceSorter;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Finder\Finder;
use Sakoo\Framework\Core\Markup\Markdown;
use Sakoo\Framework\Core\Path\Path;

#[AsCommand('doc:gen', 'Generates Document of Framework')]
class DocGenCommand extends Command
{
	public function run(Input $input, Output $output): int
	{
		$output->block('Generating ...', style: 'fg=cyan');

		if (isset($input->getArgs()[0])) {
			$finder = Finder::create($input->getArgs()[0])
				->pattern('*.php')
				->ignoreVCS()
				->ignoreVCSIgnored()
				->ignoreDotFiles()
				->getFiles();
		} else {
			$finder = Path::getCorePHPFiles();
		}

		$sorter = new NamespaceSorter();

		$formatter = new DocFormatter(new Markdown());
		$docFile = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/Home.md');
		(new Doc($finder, $formatter, $sorter, $docFile))->generate();

		$tocFormatter = new TocFormatter(new Markdown());
		$wikiSideBar = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/_Sidebar.md');
		(new Doc($finder, $tocFormatter, $sorter, $wikiSideBar))->generate();

		$wikiFooter = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/_Footer.md');
		$wikiFooter->write('Powered by Sakoo Development Group - ' . date('Y'));
		$output->block('Document has been Generated Successfully!', style: 'fg=green');

		return static::SUCCESS;
	}
}
