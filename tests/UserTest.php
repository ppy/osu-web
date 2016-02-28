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
use App\Models\BeatmapPlaycount;
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

    /**
     * Checks whether the User::isSlackEligible() method returns
     * an appropriate value depending on play count (false when <100).
     */
    public function testSlackBeatmapPlaycounts()
    {
        $this->assertTrue($this->user->isSlackEligible());

        // New empty user with no played maps
        $user = factory(User::class)->create();
        $this->assertFalse($user->isSlackEligible());
    }

    /**
     * Checks whether the User::isSlackEligible() method returns
     * an appropriate value if the user had any bans
     * in the last 28 days.
     */
    public function testSlackBanHistory()
    {
        $bh = new UserBanHistory();

        $bh->ban_status = 2;
        $bh->timestamp = Carbon::now();

        $this->user->banHistories()->save($bh);

        $this->assertFalse($this->user->isSlackEligible());

        $bh->timestamp = Carbon::now()->subDays(40);
        $bh->save();

        $this->assertTrue($this->user->isSlackEligible());
    }
}

?>
