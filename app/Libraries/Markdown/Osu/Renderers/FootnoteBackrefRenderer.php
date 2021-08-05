<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu\Renderers;

use App\Libraries\Markdown\OsuMarkdown;
use InvalidArgumentException;
use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Extension\Footnote\Node\FootnoteBackref;
use League\CommonMark\HtmlElement;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Util\ConfigurationAwareInterface;
use League\CommonMark\Util\ConfigurationInterface;

class FootnoteBackrefRenderer implements InlineRendererInterface, ConfigurationAwareInterface
{
    private string $blockName;

    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if (!($inline instanceof FootnoteBackref)) {
            throw new InvalidArgumentException('Incompatible inline type: ' . \get_class($inline));
        }

        $attrs = $inline->getData('attributes', []);
        $attrs['class'] = $this->blockName . '__link';
        $attrs['href'] = \mb_strtolower($inline->getReference()->getDestination());
        $attrs['title'] = osu_trans('wiki.show.back');

        return '&nbsp;' . new HtmlElement('a', $attrs, '&#8593;', true);
    }

    public function setConfiguration(ConfigurationInterface $configuration)
    {
        $this->blockName = $configuration->get('block_name', OsuMarkdown::DEFAULT_CONFIG['block_name']);
    }
}
