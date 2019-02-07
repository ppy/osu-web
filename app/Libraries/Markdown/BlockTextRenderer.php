<?php

namespace App\Libraries\Markdown;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\BlockQuote;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;

use League\CommonMark\Util\Xml;
use League\CommonMark\Block\Renderer\BlockRendererInterface;

class BlockTextRenderer extends AbstractRenderer implements BlockRendererInterface
{
    /**
     * @param BlockQuote               $block
     * @param ElementRendererInterface $htmlRenderer
     * @param bool                     $inTightList
     *
     * @return HtmlElement
     */
    public function render(AbstractBlock $block, ElementRendererInterface $renderer, $inTightList = false)
    {
        $rendered = [];
        $rendered[] = get_class($block);

        $text = $this->getText($block);
        if (presence($text)) {
            $rendered[] = $text;
        }

        $rendered = array_merge($rendered, $this->renderChildren($block, $renderer));

        return implode("\n", $rendered);
    }
}
