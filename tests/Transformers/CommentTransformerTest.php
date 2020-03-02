<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
            [null, false],
        ];
    }
}
