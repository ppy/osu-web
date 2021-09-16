<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Node\Block\AbstractBlock;

class Element extends AbstractBlock
{
    private string $className;

    public function __construct(string $className)
    {
        parent::__construct();

        $this->className = $className;
    }

    public function getClassName(): string
    {
        return $this->className;
    }
}
