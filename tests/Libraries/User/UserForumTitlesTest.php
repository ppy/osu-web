<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Libraries\User\UserForumTitles;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class UserForumTitlesTest extends TestCase
{
    public static function dataProviderForumTitles(): array
    {
        return [
            [3, 'Rhythm Rookie'],
            [7, 'Tempo Trainee'],
            [25, 'Whistle Blower'],
            [40, 'Cymbal Sounder'],
            [60, 'Beat Clicker'],
            [110, 'Slider Savant'],
            [150, 'Spinner Sage'],
            [200, 'Star Shooter'],
            [400, 'Combo Commander'],
            [1000, 'Rhythm Incarnate'],
        ];
    }

    #[DataProvider('dataProviderForumTitles')]
    public function testForumTitle(int $postCount, string $forumTitle)
    {
        $user = User::factory()->make();
        $user->user_posts = $postCount;

        $this->assertSame($forumTitle, UserForumTitles::get($user));
    }
}
