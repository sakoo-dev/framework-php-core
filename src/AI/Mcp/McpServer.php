<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\AI\Mcp;

use PhpMcp\Server\Exception\ConfigurationException;
use PhpMcp\Server\Exception\DiscoveryException;
use PhpMcp\Server\Server;
use Sakoo\Framework\Core\Path\Path;

class McpServer
{
	/**
	 * @throws ConfigurationException
	 * @throws DiscoveryException
	 */
	public static function factory(): Server
	{
		$server = Server::make()
			->withServerInfo('PHP MCP Server', '1.0.0')
			->build();

		$server->discover(Path::getCoreDir());

		return $server;
	}
}
