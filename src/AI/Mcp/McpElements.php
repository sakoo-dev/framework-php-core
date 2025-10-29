<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\AI\Mcp;

use JetBrains\PhpStorm\ArrayShape;
use PhpMcp\Server\Attributes\McpPrompt;
use PhpMcp\Server\Attributes\McpResource;
use PhpMcp\Server\Attributes\McpTool;
use PhpMcp\Server\Exception\McpServerException;
use Sakoo\Framework\Core\Path\Path;

class McpElements
{
	/*
	 * Tool: LLM Selects to use it, with Permission request
	 * Resource / Resource Template: User Selects to use it in his/her command
	 * Prompt: User runs as a Prompt Shortcut / Template
	 */

	#[McpTool('read_file', 'Reads content of a file in the Sakoo PHP Framework')]
	public function readFileTool(string $path): string
	{
		$path = urldecode($path);

		if (!file_exists($path)) {
			throw new McpServerException("File not found: $path");
		}

		$content = file_get_contents($path);

		if (false === $content) {
			throw new McpServerException("Failed to read file: $path");
		}

		return $content;
	}

	#[ArrayShape(['success' => 'true', 'message' => 'string'])]
	#[McpTool('write_file', 'Writes content in a new file in the Sakoo PHP Framework')]
	public function writeFileTool(string $path, string $content): array
	{
		$fullPath = urldecode($path);
		$dir = dirname($fullPath);

		if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
			throw new McpServerException("Failed to create directory: $dir");
		}

		if (false === file_put_contents($fullPath, $content)) {
			throw new McpServerException("Failed to write file: $fullPath");
		}

		return ['success' => true, 'message' => 'file stored successfully'];
	}

	#[McpTool('list_files', 'Extracts all of project files.')]
	public function getFilesListTool(): array
	{
		return $this->getFilesListResource();
	}

	#[McpResource('file://list')]
	public function getFilesListResource(): array
	{
		return $this->getFilesRecursive(Path::getCoreDir() . '/../');
	}

	#[McpPrompt('feature_from_story')]
	public function featureFromStory(string $fileName): array
	{
		$promptPath = __DIR__ . "$fileName";
		$systemPath = __DIR__ . '00-system-prompt.md';

		return [
			[
				'role' => 'user',
				'content' => "Create a sample and short code based on $promptPath file contents with conditions written in $systemPath file."
					. 'then create a file with project naming convention (PSR-4) and store it.',
			],
		];
	}

	private function getFilesRecursive(string $path): array
	{
		$output = [];

		if (!is_dir($path)) {
			return $output;
		}

		$files = scandir($path);

		if (false === $files) {
			return $output;
		}

		$files = array_diff($files, ['.', '..']);

		foreach ($files as $file) {
			if (in_array($file, ['.git', 'vendor', '.idea', 'storage', '.fleet', '.vscode', '.DS_Store'])) {
				continue;
			}

			$fullPath = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file;

			if (is_dir($fullPath)) {
				$output = array_merge($output, $this->getFilesRecursive($fullPath));
			} else {
				$output[] = $fullPath;
			}
		}

		return $output;
	}
}
