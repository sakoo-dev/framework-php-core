<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\AI\Mcp;

use PhpMcp\Server\Attributes\McpPrompt;
use PhpMcp\Server\Attributes\McpResource;
use PhpMcp\Server\Attributes\McpTool;
use PhpMcp\Server\JsonRpc\Contents\PromptMessage;
use Sakoo\Framework\Core\Assert\Assert;
use Sakoo\Framework\Core\FileSystem\Disk;
use Sakoo\Framework\Core\FileSystem\File;
use Sakoo\Framework\Core\Finder\FileFinder;
use Sakoo\Framework\Core\Path\Path;

/*
 * Tool: LLM Selects to use it, with Permission request
 * Resource / Resource Template: User Selects to use it in their command
 * Prompt: User runs as a Prompt Shortcut / Template
*/
class McpElements
{
	#[McpTool('read_file', 'Reads content of a file in the Sakoo PHP Framework')]
	public function readFileTool(string $path): string
	{
		$lines = File::open(Disk::Local, $path)->readLines();
		Assert::array($lines, "The path '{$path}' does not exist.");

		// @phpstan-ignore argument.type
		return implode(PHP_EOL, $lines);
	}

	/**
	 * @return array<string,bool|string>
	 */
	#[McpTool('write_file', 'Writes content in a new file in the Sakoo PHP Framework')]
	public function writeFileTool(string $path, string $content): array
	{
		if (File::open(Disk::Local, $path)->write($content)) {
			return ['success' => true, 'message' => 'file stored successfully'];
		}

		return ['success' => false, 'message' => 'failed to store file'];
	}

	/**
	 * @return string[]
	 */
	#[McpTool('list_files', 'Extracts all of project files.')]
	public function getFilesListTool(): array
	{
		return $this->getFilesListResource();
	}

	/**
	 * @return string[]
	 */
	#[McpResource('file://list')]
	public function getFilesListResource(): array
	{
		$path = Path::getCoreDir() . '/../';

		return (new FileFinder($path))
			->ignoreDotFiles()
			->ignoreVCS()
			->ignoreVCSIgnored()
			->find();
	}

	#[McpPrompt('feature_from_story')]
	public function featureFromStory(string $fileName): PromptMessage
	{
		$promptPath = __DIR__ . "$fileName";
		$systemPath = __DIR__ . '00-system-prompt.md';

		return PromptMessage::user("Create a sample and short code based on $promptPath "
			. "file contents with conditions written in $systemPath file."
			. 'then create a file with project naming convention (PSR-4) and store it.');
	}
}
