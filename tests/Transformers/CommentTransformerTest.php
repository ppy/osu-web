<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Transformers;

use App\Models\Comment;
use Tests\TestCase;

class CommentTransformerTest extends TestCase
{
    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithOAuth($groupIdentifier)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $comment = factory(Comment::class)->states('deleted')->create();
        $this->actAsScopedUser($viewer);

        $json = json_item($comment, 'Comment');

        $this->assertArrayNotHasKey('message', $json);
        $this->assertArrayNotHasKey('message_html', $json);
    }

    /**
     * @dataProvider groupsDataProvider
     */
    public function testWithoutOAuth($groupIdentifier, $visible)
    {
        $viewer = $this->createUserWithGroup($groupIdentifier);
        $comment = factory(Comment::class)->states('deleted')->create();
        $this->actAsUser($viewer);

        $json = json_item($comment, 'Comment');

        if ($visible) {
            $this->assertArrayHasKey('message', $json);
            $this->assertArrayHasKey('message_html', $json);
        } else {
            $this->assertArrayNotHasKey('message', $json);
            $this->assertArrayNotHasKey('message_html', $json);
        }
    }

    public function groupsDataProvider()
    {
        return [
            ['admin', true],
            ['bng', false],
            ['gmt', true],
            ['nat', true],
            [[], false],
        ];
    }
}
