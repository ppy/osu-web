<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use League\CommonMark\Parser\Block\BlockContinue;
use League\CommonMark\Parser\Block\BlockContinueParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Util\RegexHelper;

class Parser extends AbstractBlockContinueParser
{
    private Element $block;


    public function __construct(string $className, string $fence)
    {
        $this->block = new Element($className, $fence);
    }

    public function getBlock(): AbstractBlock
    {
        return $this->block;
    }

    public function isContainer(): bool
    {
        return true;
    }

    public function canContain(AbstractBlock $childBlock): bool
    {
        return true;
    }

    public function tryContinue(Cursor $cursor, BlockContinueParserInterface $activeBlockParser): ?BlockContinue
    {
        if (!$cursor->isIndented() && $cursor->getNextNonSpaceCharacter() === ':') {
            $match = RegexHelper::matchFirst('/^(?:\:{3,})(?=.*$)/', $cursor->getLine(), $cursor->getNextNonSpacePosition());
            if ($match !== null && $match[0] === $this->block->getFence()) {
                return BlockContinue::finished();
            }
        }

        return BlockContinue::at($cursor);
    }
}
