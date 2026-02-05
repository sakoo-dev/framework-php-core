<?php

declare(strict_types=1);

namespace Sakoo\Framework\Core\Tests\Markup;

use PHPUnit\Framework\Attributes\Test;
use Sakoo\Framework\Core\Markup\Markdown;
use Sakoo\Framework\Core\Tests\TestCase;

final class MarkdownTest extends TestCase
{
	private Markdown $markdown;

	protected function setUp(): void
	{
		parent::setUp();
		$this->markdown = new Markdown();
	}

	#[Test]
	public function it_makes_link_in_markdown(): void
	{
		$this->markdown->link('https://www.google.com', 'Google Link');
		$this->assertEquals('[Google Link](https://www.google.com)', $this->markdown);
	}

	#[Test]
	public function it_makes_image_in_markdown(): void
	{
		$this->markdown->image('https://www.google.com/images/text', 'Image alt');
		$this->assertEquals('![Image alt](https://www.google.com/images/text)', $this->markdown);
	}

	#[Test]
	public function it_makes_text_in_markdown(): void
	{
		$this->markdown->write('Hello');
		$this->markdown->write('World');
		$this->assertEquals('HelloWorld', $this->markdown);
	}

	#[Test]
	public function it_makes_line_text_in_markdown(): void
	{
		$this->markdown->writeLine('Hello');
		$this->markdown->writeLine('World');
		$this->assertEquals("Hello\n\nWorld\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_break_line_in_markdown(): void
	{
		$this->markdown->write('Hello');
		$this->markdown->br();
		$this->markdown->write('World');
		$this->assertEquals("Hello\n\nWorld", $this->markdown);
	}

	#[Test]
	public function it_makes_force_break_line_in_markdown(): void
	{
		$this->markdown->write('Hello');
		$this->markdown->fbr();
		$this->markdown->write('World');
		$this->assertEquals('Hello<br>World', $this->markdown);
	}

	#[Test]
	public function it_makes_code_block_in_markdown(): void
	{
		$this->markdown->code('Code Snippet', 'php');
		$this->assertEquals("```php\nCode Snippet\n```\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_callout_in_markdown(): void
	{
		$this->markdown->callout('An Important Text');
		$this->assertEquals("> An Important Text\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_inline_code_in_markdown(): void
	{
		$this->markdown->inlineCode('Inline Code');
		$this->assertEquals('`Inline Code`', $this->markdown);
	}

	#[Test]
	public function it_makes_horizontal_line_in_markdown(): void
	{
		$this->markdown->hr();
		$this->assertEquals("---\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_heading1_in_markdown(): void
	{
		$this->markdown->h1('Heading 1');
		$this->assertEquals("# Heading 1\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_heading2_in_markdown(): void
	{
		$this->markdown->h2('Heading 2');
		$this->assertEquals("## Heading 2\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_heading3_in_markdown(): void
	{
		$this->markdown->h3('Heading 3');
		$this->assertEquals("### Heading 3\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_heading4_in_markdown(): void
	{
		$this->markdown->h4('Heading 4');
		$this->assertEquals("#### Heading 4\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_heading5_in_markdown(): void
	{
		$this->markdown->h5('Heading 5');
		$this->assertEquals("##### Heading 5\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_heading6_in_markdown(): void
	{
		$this->markdown->h6('Heading 6');
		$this->assertEquals("###### Heading 6\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_unordered_list_in_markdown(): void
	{
		$this->markdown->ul('Item');
		$this->assertEquals("- Item\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_unchecked_checklist_in_markdown(): void
	{
		$this->markdown->checklist('Checklist Item');
		$this->assertEquals("[] Checklist Item\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_checked_checklist_in_markdown(): void
	{
		$this->markdown->checklist('Checklist Item', true);
		$this->assertEquals("[X] Checklist Item\n\n", $this->markdown);
	}

	#[Test]
	public function it_makes_tiny_text_in_markdown(): void
	{
		$this->markdown->tiny('Tiny Text');
		$this->assertEquals("<sub><sup>Tiny Text</sup></sub>\n\n", $this->markdown);
	}
}
