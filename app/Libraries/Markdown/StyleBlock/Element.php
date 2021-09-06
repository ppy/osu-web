<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Node\Block\AbstractBlock;

class Element extends AbstractBlock
{
    private string $className;

    private string $fence;

    public function __construct(string $className, string $fence)
    {
        parent::__construct();

        $this->className = $className;
        $this->fence = $fence;
    }

    public function getClassName(): string
    {
        return $this->className;
    }


    public function getFence(): string
    {
        return $this->fence;
    }
}
