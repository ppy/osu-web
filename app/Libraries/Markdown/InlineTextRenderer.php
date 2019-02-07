<?php

namespace App\Libraries\Markdown;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Element\Emphasis;
use League\CommonMark\Util\Xml;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;

class InlineTextRenderer extends AbstractRenderer implements InlineRendererInterface
{
    /**
     * @param Emphasis                 $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return HtmlElement
     */
    public function render(AbstractInline $inline, ElementRendererInterface $renderer)
    {
        $rendered = [];
        $rendered[] = get_class($inline);


        $text = $this->getText($inline);
        if (presence($text)) {
            $rendered[] = $text;
        }

        $rendered = array_merge($rendered, $this->renderChildren($inline, $renderer));

        return implode('', $rendered);
    }
}
