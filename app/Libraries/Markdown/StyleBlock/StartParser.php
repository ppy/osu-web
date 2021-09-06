<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\MarkdownParserStateInterface;

class StartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if ($cursor->isIndented() || $cursor->getNextNonSpaceCharacter() !== ':') {
            return BlockStart::none();
        }

        $fence = $cursor->match('/^(?:\:{3,}(?!.*\:))/');

        if ($fence === null) {
            return BlockStart::none();
        }

        $className = mb_strtolower(str_replace(' ', '-', trim($cursor->getRemainder())));

        if (!present($className)) {
            return BlockStart::none();
        }

        $cursor->advanceToEnd();

        return BlockStart::of(new Parser($className, $fence))->at($cursor);
    }
}
