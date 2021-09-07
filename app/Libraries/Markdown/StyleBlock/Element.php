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

    private string $fenceChar;

    public function __construct(string $class, string $fenceChar)
    {
        $this->class = $class;
        $this->fenceChar = $fenceChar;
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
        $currentLine = $cursor->getRemainder();

        if (
            ($currentLine === '}}}' && $this->fenceChar === '{') ||
            ($currentLine === ':::' && $this->fenceChar === ':')
        ) {
            $cursor->advanceToEnd();

            return false;
        }

        return true;
    }
}
