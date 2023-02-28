<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Forum\Forum;
use Tests\TestCase;

class ForumForumsControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $this
            ->get(route('forum.forums.index'))
            ->assertStatus(200);
    }

    public function testShow(): void
    {
        $forum = Forum::factory()->create();

        $this
            ->get(route('forum.forums.show', $forum))
            ->assertStatus(200);
    }
}
