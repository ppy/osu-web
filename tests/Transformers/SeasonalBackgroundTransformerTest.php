<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Transformers;

use App\Models\User;
use App\Models\UserContestEntry;
use App\Transformers\SeasonalBackgroundTransformer;
use Tests\TestCase;

class SeasonalBackgroundTransformerTest extends TestCase
{
    public function testBasic(): void
    {
        $entry = UserContestEntry::create([
            'hash' => hash('sha256', ''),
            'user_id' => User::factory()->create()->getKey(),
        ]);

        $json = json_item($entry, new SeasonalBackgroundTransformer());

        $this->assertNotNull($json['url']);
    }
}
