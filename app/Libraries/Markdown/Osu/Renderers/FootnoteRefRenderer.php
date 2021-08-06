<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use App\Libraries\Markdown\OsuMarkdown;
use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\Footnote\Node\FootnoteRef;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\ConfigurationInterface;

class FootnoteRefRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    private string $blockName;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof FootnoteRef)) {
            throw new InvalidArgumentException('Incompatible inline type: '.\get_class($inline));
        }

        $attrs = $inline->getData('attributes', []);
        $attrs['id'] = 'fnref:'.\mb_strtolower($inline->getReference()->getLabel());
        $attrs['class'] = $this->blockName.'__superscript';

        $target = \mb_strtolower($inline->getReference()->getDestination());

        return new HtmlElement(
            'sup',
            $attrs,
            new HtmlElement(
                'a',
                [
                    'class' => $this->blockName.'__link'.' js-reference-link',
                    'data-target' => $target,
                    'href' => $target,
                ],
                '['.$inline->getReference()->getTitle().']',
            ),
        );
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->blockName = $configuration->get('block_name', OsuMarkdown::DEFAULT_CONFIG['block_name']);
    }
}
