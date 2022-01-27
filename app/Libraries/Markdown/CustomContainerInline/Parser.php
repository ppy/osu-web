<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CustomContainerInline;

use League\CommonMark\Delimiter\DelimiterInterface;
use League\CommonMark\Delimiter\Processor\DelimiterProcessorInterface;
use League\CommonMark\Node\Inline\AbstractStringContainer;

class Parser implements DelimiterProcessorInterface
{
    public function getOpeningCharacter(): string
    {
        return ':';
    }

    public function getClosingCharacter(): string
    {
        return ':';
    }

    public function getMinLength(): int
    {
        return 2;
    }

    public function getDelimiterUse(DelimiterInterface $opener, DelimiterInterface $closer): int
    {
        return 2;
    }

    public function process(AbstractStringContainer $opener, AbstractStringContainer $closer, int $delimiterUse): void
    {
        $inline = new Element();

        $next = $opener->next();
        while ($next !== null && $next !== $closer) {
            $inline->appendChild($next);
            $next = $next->next();
        }

        $opener->insertAfter($inline);
    }
}
