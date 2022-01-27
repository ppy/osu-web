<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Forum;
use Tests\TestCase;

class ForumForumsControllerTest extends TestCase
{
    public function testIndex()
    {
        $this
            ->get(route('forum.forums.index'))
            ->assertStatus(200);
    }

    public function testShow()
    {
        $forum = factory(Forum\Forum::class)->states('parent')->create();

        $this
            ->get(route('forum.forums.show', $forum->forum_id))
            ->assertStatus(200);
    }
}
