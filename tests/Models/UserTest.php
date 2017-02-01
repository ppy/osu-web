<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
use App\Models\Beatmap;
use App\Models\BeatmapPlaycount;
use App\Models\User;
use App\Models\UserBanHistory;
use Carbon\Carbon;

class UserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->beatmap = new Beatmap();
        $this->beatmap->save();

        $this->pc = new BeatmapPlaycount();
        $this->pc->beatmap_id = $this->beatmap->beatmap_id;
        $this->pc->playcount = 150;

        $this->user = factory(User::class)->create();
        $this->user->beatmapPlaycounts()->save($this->pc);
    }
}
