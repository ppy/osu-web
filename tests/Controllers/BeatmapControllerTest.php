<?php
/**
 *    Copyright 2015 ppy Pty. Ltd.
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
use App\Models\User;
use App\Models\Beatmap;

class BeatmapControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->beatmap = factory(Beatmap::class)->create();
    }

    /**
     * Checks whether HTTP 403 is thrown when a logged out
     * user tries to access the non-general (country or friend ranking)
     * scoreboards.
     */
    public function testNonGeneralScoreboardLoggedOut()
    {
        $this->json('GET', route('beatmaps.scores', ['id' => $this->beatmap->beatmap_id]), [
            'type' => 'country',
        ])->seeStatusCode(403);
    }

    /**
     * Checks whether an error is thrown when an user without supporter
     * tries to access supporter-only scoreboards.
     */
    public function testNonGeneralScoreboardSupporter()
    {
        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['id' => $this->beatmap->beatmap_id]), [
                'type' => 'country',
            ])->seeStatusCode(422)
            ->seeJson(['error' => trans('errors.supporter_only')]);

        $this->user->osu_subscriber = true;
        $this->user->save();

        $this->actingAs($this->user)
            ->json('GET', route('beatmaps.scores', ['id' => $this->beatmap->beatmap_id]), [
                'type' => 'country',
            ])->seeStatusCode(200);
    }
}
