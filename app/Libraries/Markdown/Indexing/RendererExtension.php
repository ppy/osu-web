<?php

namespace App\Libraries\Markdown\Indexing;

use League\CommonMark\Extension\CommonMarkCoreExtension;

class RendererExtension extends CommonMarkCoreExtension
{
    public function getBlockRenderers()
    {
        return [
            'League\CommonMark\Block\Element\BlockQuote'    => new BlockRenderer,
            'League\CommonMark\Block\Element\Document'      => new BlockRenderer,
            'League\CommonMark\Block\Element\FencedCode'    => new NoopRenderer,
            'League\CommonMark\Block\Element\Heading'       => new NoopRenderer,
            'League\CommonMark\Block\Element\HtmlBlock'     => new BlockRenderer,
            'League\CommonMark\Block\Element\IndentedCode'  => new BlockRenderer,
            'League\CommonMark\Block\Element\ListBlock'     => new BlockRenderer,
            'League\CommonMark\Block\Element\ListItem'      => new BlockRenderer,
            'League\CommonMark\Block\Element\Paragraph'     => new BlockRenderer,
            'League\CommonMark\Block\Element\ThematicBreak' => new BlockRenderer,
            'Webuni\CommonMark\TableExtension\Table'        => new TableRenderer,
            'Webuni\CommonMark\TableExtension\TableCaption' => new NoopRenderer,
            'Webuni\CommonMark\TableExtension\TableRows'    => new TableRenderer,
            'Webuni\CommonMark\TableExtension\TableRow'     => new TableRenderer,
            'Webuni\CommonMark\TableExtension\TableCell'    => new TableRenderer,
        ];
    }

    public function getInlineRenderers()
    {
        return [
            'League\CommonMark\Inline\Element\Code'       => new InlineRenderer,
            'League\CommonMark\Inline\Element\Emphasis'   => new InlineRenderer,
            'League\CommonMark\Inline\Element\HtmlInline' => new InlineRenderer,
            'League\CommonMark\Inline\Element\Image'      => new NoopRenderer,
            'League\CommonMark\Inline\Element\Link'       => new InlineRenderer,
            'League\CommonMark\Inline\Element\Newline'    => new NoopRenderer,
            'League\CommonMark\Inline\Element\Strong'     => new InlineRenderer,
            'League\CommonMark\Inline\Element\Text'       => new InlineRenderer,
        ];
    }
}
