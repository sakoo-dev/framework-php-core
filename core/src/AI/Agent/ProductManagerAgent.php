<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\AI\Agent;

use NeuronAI\Agent;
use NeuronAI\MCP\McpConnector;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\OpenAI\OpenAI;
use NeuronAI\SystemPrompt;

class ProductManagerAgent extends Agent
{
	protected function provider(): AIProviderInterface
	{
		return new OpenAI(
			key: 'OPENAI_API_KEY',
			model: 'OPENAI_MODEL',
		);
	}

	public function instructions(): string
	{
		return (string) new SystemPrompt(
			background: [__DIR__ . '/../Prompt/00-system-prompt.md'],
		);
	}

	protected function tools(): array
	{
		return [
			...McpConnector::make([
				'command' => 'npx',
				'args' => ['-y', '@modelcontextprotocol/server-everything'],
			])->tools(),
		];
	}
}
