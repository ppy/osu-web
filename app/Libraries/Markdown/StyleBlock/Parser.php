<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Block\Parser\BlockParserInterface;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

class Parser implements BlockParserInterface
{
    public function parse(ContextInterface $context, Cursor $cursor): bool
    {
        if ($cursor->match('#^\{{3}[ \t]*#') === null) {
            return false;
        }

        $class = mb_strtolower(str_replace(' ', '-', trim($cursor->getRemainder())));

        $cursor->advanceToEnd();
        $context->addBlock(new Element($class));

        return true;
    }
}
