<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Cursor;

class Element extends AbstractBlock
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var static[]
     */
    protected $containedStyleBlocks = [];

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function canContain(AbstractBlock $block): bool
    {
        if ($block instanceof static) {
            $this->containedStyleBlocks[] = $block;
        }

        return true;
    }

    public function isCode(): bool
    {
        return false;
    }

    public function matchesNextLine(Cursor $cursor): bool
    {
        // Make sure the most nested open StyleBlock tries to handle this first
        if ($cursor->getLine() === '}}}' && !$this->containsOpenStyleBlock()) {
            $cursor->advanceToEnd();

            return false;
        }

        return true;
    }

    private function containsOpenStyleBlock(): bool
    {
        // Assumes that these StyleBlocks are never removed from descendant tree
        foreach ($this->containedStyleBlocks as $styleBlock) {
            if ($styleBlock->isOpen()) {
                return true;
            }
        }

        return false;
    }
}
