<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use PhpMcp\Server\Transports\StdioServerTransport;
use Sakoo\Framework\Core\AI\Mcp\McpServer;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;

class McpServerCommand extends Command
{
	public static function getName(): string
	{
		return 'mcp:run';
	}

	public static function getDescription(): string
	{
		return 'Creates a MCP server in the Sakoo PHP Framework Context';
	}

	public function run(Input $input, Output $output): int
	{
		try {
			$output->info('Sakoo PHP MCP Server has been Started ...');
			McpServer::factory()->listen(new StdioServerTransport());
		} catch (\Throwable $e) {
			fwrite(STDERR, '[CRITICAL ERROR] ' . $e->getMessage() . "\n");

			return Output::ERROR;
		}

		return Output::SUCCESS;
	}
}
