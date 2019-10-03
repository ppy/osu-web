<?php

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
        $forum = factory(Forum\Forum::class, 'parent')->create();

        $this
            ->get(route('forum.forums.show', $forum->forum_id))
            ->assertStatus(200);
    }
}
