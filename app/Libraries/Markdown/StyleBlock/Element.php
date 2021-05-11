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
        $walker = $this->walker();
        $walker->next();

        while (($event = $walker->next()) !== null) {
            if (!$event->isEntering()) {
                continue;
            }

            $node = $event->getNode();

            if ($node instanceof static && $node->isOpen()) {
                return true;
            }
        }

        return false;
    }
}
