<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Opengraph;

use App\Models\Contest;

class ContestOpengraph
{
    public function __construct(private Contest $contest)
    {
    }

    public function get(): array
    {
        return [
            'description' => strip_tags(markdown($this->contest->currentDescription())),
            'image' => $this->contest->header_url,
            'title' => $this->contest->name,
        ];
    }
}
