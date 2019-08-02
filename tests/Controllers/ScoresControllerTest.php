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
use App\Models\Score\Best\Osu;
use App\Models\User;

class ScoresControllerTest extends TestCase
{
    private $score;
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->score = factory(Osu::class)->create();
    }

    public function testDownload()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'POST',
                route('scores.report', ['mode' => 'osu', 'score' => $this->score->getKey()])
            )
            ->assertSuccessful();
    }

    public function testDownloadInvalidMode()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'GET',
                route('scores.download', ['mode' => 'nope', 'score' => $this->score->getKey()])
            )
            ->assertStatus(404);
    }

    public function testReport()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'POST',
                route('scores.report', ['mode' => 'osu', 'score' => $this->score->getKey()])
            )
            ->assertSuccessful();
    }

    public function testReportInvalidMode()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'POST',
                route('scores.report', ['mode' => 'nope', 'score' => $this->score->getKey()])
            )
            ->assertStatus(404);
    }
}
