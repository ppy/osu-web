<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldBeUnique;

class EsDocumentUnique extends EsDocument implements ShouldBeUnique
{
    public int $uniqueFor = 600;

    public function uniqueId(): string
    {
        return "{$this->modelMeta['class']}-{$this->modelMeta['id']}";
    }
}
