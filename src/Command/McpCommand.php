<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Command;

use PhpMcp\Server\Server;
use PhpMcp\Server\Transports\StdioServerTransport;
use Sakoo\Framework\Core\Console\Command;
use Sakoo\Framework\Core\Console\Input;
use Sakoo\Framework\Core\Console\Output;
use Sakoo\Framework\Core\Path\Path;

class McpCommand extends Command
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
			$server = Server::make()
				->withServerInfo('PHP MCP Server', '1.0.0')
				->build();

			$server->discover(Path::getCoreDir());

			$transport = new StdioServerTransport();
			$server->listen($transport);
		} catch (\Throwable $e) {
			fwrite(STDERR, '[CRITICAL ERROR] ' . $e->getMessage() . "\n");

			return Output::ERROR;
		}

		return Output::SUCCESS;
	}
}
