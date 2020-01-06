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

namespace Tests\Controllers;

use App\Models\Multiplayer\Event;
use App\Models\Multiplayer\Match;
use App\Models\User;
use Tests\TestCase;

class MatchesControllerTest extends TestCase
{
    private $privateMatch;
    private $privateMatchRoute;
    private $publicMatch;
    private $publicMatchRoute;
    private $user;

    public function testPublicMatchLoggedOut() // OK
    {
        $this
            ->get($this->publicMatchRoute)
            ->assertStatus(200);
    }

    public function testPublicMatchLoggedInNotParticipated() // OK
    {
        $this
            ->actingAs($this->user)
            ->get($this->publicMatchRoute)
            ->assertStatus(200);
    }

    public function testPublicMatchLoggedInParticipated() // OK
    {
        factory(Event::class)->states('join')->create([
            'user_id' => $this->user->user_id,
            'match_id' => $this->publicMatch->match_id,
        ]);

        $this
            ->actingAs($this->user)
            ->get($this->publicMatchRoute)
            ->assertStatus(200);
    }

    public function testPrivateMatchLoggedOut() // Login Required
    {
        $this
            ->get($this->privateMatchRoute)
            ->assertSeeText('Please sign in to continue')
            ->assertStatus(401);
    }

    public function testPrivateMatchLoggedInNotParticipated() // Access Denied
    {
        $this
            ->actingAs($this->user)
            ->get($this->privateMatchRoute)
            ->assertStatus(403);
    }

    public function testPrivateMatchLoggedInHost() // OK
    {
        factory(Event::class)->states('create')->create([
            'user_id' => $this->user->user_id,
            'match_id' => $this->privateMatch->match_id,
        ]);

        $this
            ->actingAs($this->user)
            ->get($this->privateMatchRoute)
            ->assertStatus(200);
    }

    public function testPrivateMatchLoggedInParticipated() // OK
    {
        factory(Event::class)->states('join')->create([
            'user_id' => $this->user->user_id,
            'match_id' => $this->privateMatch->match_id,
        ]);

        $this
            ->actingAs($this->user)
            ->get($this->privateMatchRoute)
            ->assertStatus(200);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->publicMatch = factory(Match::class)->create();
        factory(Event::class)->states('create')->create([
            'match_id' => $this->publicMatch->match_id,
        ]);
        $this->publicMatchRoute = route('matches.show', $this->publicMatch->match_id);

        $this->privateMatch = factory(Match::class)->states('private')->create();
        factory(Event::class)->states('create')->create([
            'match_id' => $this->privateMatch->match_id,
        ]);
        $this->privateMatchRoute = route('matches.show', $this->privateMatch->match_id);
    }
}
