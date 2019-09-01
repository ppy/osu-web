<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Adapted from PHPLeague's CommonMark code fence implementation:
 * https://github.com/thephpleague/commonmark/blob/master/src/Block/Parser/FencedCodeParser.php
 */

namespace App\Libraries\Markdown\Block\Parser;

use App\Libraries\Markdown\Block\Element\WikiSection;
use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

class WikiSectionParser implements BlockParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'WikiSectionParser';
    }

    /**
     * @param ContextInterface $context
     * @param Cursor           $cursor
     *
     * @return bool
     */
    public function parse(ContextInterface $context, Cursor $cursor)
    {
        if ($cursor->isIndented()) {
            return false;
        }

        $indent = $cursor->getIndent();
        $fence = $cursor->match('/^[ \t]*(?:"{3,}(?!.*"))/');
        if ($fence === null) {
            return false;
        }

        // fenced code block
        $fence = ltrim($fence, " \t");
        $fenceLength = strlen($fence);
        $context->addBlock(new WikiSection($fenceLength, $fence[0], $indent));

        return true;
    }
}
