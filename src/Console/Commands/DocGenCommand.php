<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Console\Commands;

use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Doc\Doc;
use Sakoo\Framework\Core\Doc\Formatters\NamespaceBasedFormatter;
use Sakoo\Framework\Core\Doc\Formatters\TocFormatter;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Path\Path;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('doc:gen', 'Generates Document of Framework')]
class DocGenCommand extends Command
{
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$style = new SymfonyStyle($input, $output);
		$style->block('Generating ...', style: 'fg=cyan');

		$excluded = [
			'Loaders.php',
			'helpers.php',
			'Bootstrap.php',
		];

		$finder = Path::getCorePHPFiles($excluded);
		$formatter = new NamespaceBasedFormatter();
		$docFile = File::open(Disk::Local, Path::getStorageDir() . '/doc/Doc.md');
		(new Doc($finder, $formatter, $docFile))->generate();

		$wikiFile = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/');
		$wikiFile->remove();
		$docFile->copy($wikiFile->getPath() . 'Home.md');

		$tocFormatter = new TocFormatter();
		$wikiSideBar = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/_Sidebar.md');
		(new Doc($finder, $tocFormatter, $wikiSideBar))->generate();

		$wikiFooter = File::open(Disk::Local, Path::getRootDir() . '/.github/wiki/_Footer.md');
		$wikiFooter->write('Powered by Sakoo Development Group - ' . date('Y'));

		$style->block('Document has been Generated Successfully!', style: 'fg=green');

		return static::SUCCESS;
	}
}
