<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\CustomContainerInline;

use League\CommonMark\Node\Inline\AbstractInline;
use League\CommonMark\Node\Inline\DelimitedInterface;

class Element extends AbstractInline implements DelimitedInterface
{
    public function getOpeningDelimiter(): string
    {
        return ':';
    }

    public function getClosingDelimiter(): string
    {
        return ':';
    }
}
