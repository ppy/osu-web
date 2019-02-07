<?php

namespace App\Libraries\Markdown;

use League\CommonMark\Extension\CommonMarkCoreExtension;

class IndexingTextRendererExtension extends CommonMarkCoreExtension
{
    public function getBlockRenderers()
    {
        return [
            'League\CommonMark\Block\Element\BlockQuote'    => new BlockTextRenderer,
            'League\CommonMark\Block\Element\Document'      => new BlockTextRenderer,
            'League\CommonMark\Block\Element\FencedCode'    => new BlockTextRenderer,
            'League\CommonMark\Block\Element\Heading'       => new BlockTextRenderer,
            'League\CommonMark\Block\Element\HtmlBlock'     => new BlockTextRenderer,
            'League\CommonMark\Block\Element\IndentedCode'  => new BlockTextRenderer,
            'League\CommonMark\Block\Element\ListBlock'     => new BlockTextRenderer,
            'League\CommonMark\Block\Element\ListItem'      => new BlockTextRenderer,
            'League\CommonMark\Block\Element\Paragraph'     => new BlockTextRenderer,
            'League\CommonMark\Block\Element\ThematicBreak' => new BlockTextRenderer,
        ];
    }

    public function getInlineRenderers()
    {
        return [
            'League\CommonMark\Inline\Element\Code'       => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\Emphasis'   => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\HtmlInline' => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\Image'      => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\Link'       => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\Newline'    => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\Strong'     => new InlineTextRenderer,
            'League\CommonMark\Inline\Element\Text'       => new InlineTextRenderer,
        ];
    }
}
