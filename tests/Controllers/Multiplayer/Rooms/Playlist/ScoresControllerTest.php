<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Multiplayer\Rooms\Playlist;

use App\Models\Multiplayer\PlaylistItem;
use App\Models\Multiplayer\Score;
use App\Models\User;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    public function testShow()
    {
        $score = factory(Score::class)->create();
        $user = factory(User::class)->create();

        $this->actAsScopedUser($user, ['*']);

        $this->json('GET', route('api.rooms.playlist.scores.show', [
            'room' => $score->room_id,
            'playlist' => $score->playlist_item_id,
            'score' => $score->getKey(),
        ]))->assertSuccessful();
    }
}
