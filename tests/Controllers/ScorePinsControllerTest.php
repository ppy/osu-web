<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Score\Best\Osu;
use App\Models\Score\Best\Taiko;
use App\Models\ScorePin;
use App\Models\User;
use Tests\TestCase;

class ScorePinsControllerTest extends TestCase
{
    public function testDestroy()
    {
        $pin = ScorePin::factory()->withScore(Osu::factory()->create())->create();

        $initialPinCount = ScorePin::count();

        $this->actAsUser($pin->user, true);

        $this
            ->delete(route('score-pins.destroy', $this->makeParams($pin->score)))
            ->assertSuccessful();

        $this->assertSame(ScorePin::count(), $initialPinCount - 1);
    }

    public function testDestroyAsDifferentUser()
    {
        $pin = ScorePin::factory()->withScore(Osu::factory()->create())->create();
        $otherUser = User::factory()->create();

        $initialPinCount = ScorePin::count();

        $this->actAsUser($otherUser, true);

        $this
            ->delete(route('score-pins.destroy', $this->makeParams($pin->score)))
            ->assertSuccessful();

        $this->assertSame(ScorePin::count(), $initialPinCount);
    }

    public function testDestroyAsGuest()
    {
        $pin = ScorePin::factory()->withScore(Osu::factory()->create())->create();

        $initialPinCount = ScorePin::count();

        $this
            ->delete(route('score-pins.destroy', $this->makeParams($pin->score)))
            ->assertStatus(401);

        $this->assertSame(ScorePin::count(), $initialPinCount);
    }

    // moving: [0]. expected order: [1] < [0]
    public function testReorderMoveBottom()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(Osu::factory(['user_id' => $user])->create())
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder'), array_merge($this->makeParams($pins[0]->score), ['order1_score_id' => $pins[1]->score_id]))
            ->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[1]->display_order < $pins[0]->display_order);
    }

    // moving: [0]. expected order: [1] < [0] < [2]
    public function testReorderMoveDown()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1, 2])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(Osu::factory(['user_id' => $user])->create())
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder'), array_merge($this->makeParams($pins[0]->score), ['order1_score_id' => $pins[1]->score_id]))
            ->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[1]->display_order < $pins[0]->display_order);
        $this->assertTrue($pins[0]->display_order < $pins[2]->display_order);
    }

    // moving: [1]. expected order: [1] < [0]
    public function testReorderMoveTop()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(Osu::factory(['user_id' => $user])->create())
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder'), array_merge($this->makeParams($pins[1]->score), ['order3_score_id' => $pins[0]->score_id]))
            ->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[1]->display_order < $pins[0]->display_order);
    }

    // moving: [2]. expected order: [0] < [2] < [1]
    public function testReorderMoveUp()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1, 2])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(Osu::factory(['user_id' => $user])->create())
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder'), array_merge($this->makeParams($pins[2]->score), ['order1_score_id' => $pins[0]->score_id]))
            ->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[0]->display_order < $pins[2]->display_order);
        $this->assertTrue($pins[2]->display_order < $pins[1]->display_order);
    }

    public function testStore()
    {
        $score = Osu::factory()->create();

        $initialPinCont = ScorePin::count();

        $this->actAsUser($score->user, true);

        $this
            ->post(route('score-pins.store'), $this->makeParams($score))
            ->assertSuccessful();

        $this->assertSame(ScorePin::count(), $initialPinCont + 1);
    }

    public function testStoreAsGuest()
    {
        $score = Osu::factory()->create();

        $initialPinCont = ScorePin::count();

        $this
            ->post(route('score-pins.store'), $this->makeParams($score))
            ->assertStatus(401);

        $this->assertSame(ScorePin::count(), $initialPinCont);
    }

    public function testStoreAsNonOwner()
    {
        $score = Osu::factory()->create();
        $otherUser = User::factory()->create();

        $initialPinCont = ScorePin::count();

        $this->actAsUser($otherUser, true);

        $this
            ->post(route('score-pins.store'), $this->makeParams($score))
            ->assertStatus(403);

        $this->assertSame(ScorePin::count(), $initialPinCont);
    }

    // new score pin should always be above existing ones
    public function testStoreDisplayOrder()
    {
        $user = User::factory()->create([
            'osu_subscriber' => false,
        ]);
        $score1 = Osu::factory()->create(['user_id' => $user]);
        $score2 = Osu::factory()->create(['user_id' => $user]);
        $pin1 = ScorePin::factory()->withScore($score1, 'score')->create();

        $this->actAsUser($user, true);

        $this
            ->post(route('score-pins.store'), $this->makeParams($score2))
            ->assertSuccessful();

        $responsePin = $user->scorePins()->whereMorphedTo('score', $score2)->first();
        $this->assertTrue($pin1->display_order > $responsePin->display_order);
    }

    public function testStoreDuplicate()
    {
        $score = Osu::factory()->create();
        $pin = ScorePin::factory()->withScore($score, 'score')->create();

        $initialPinCont = ScorePin::count();

        $this->actAsUser($score->user, true);

        $this
            ->post(route('score-pins.store'), $this->makeParams($score))
            ->assertSuccessful();

        $this->assertSame(ScorePin::count(), $initialPinCont);
    }

    public function testStoreInvalidScoreId()
    {
        Osu::find(1)?->destroy();

        $initialPinCont = ScorePin::count();

        $this->actAsUser(User::factory()->create(), true);

        $this
            ->post(route('score-pins.store'), ['score_type' => 'score_best_osu', 'score_id' => 1])
            ->assertStatus(422);

        $this->assertSame(ScorePin::count(), $initialPinCont);
    }

    public function testStoreInvalidScoreMode()
    {
        $score = Osu::factory()->create();

        $initialPinCont = ScorePin::count();

        $this->actAsUser(User::factory()->create(), true);

        $this
            ->post(route('score-pins.store'), ['score_type' => '_invalid', 'score_id' => $score->getKey()])
            ->assertStatus(422);

        $this->assertSame(ScorePin::count(), $initialPinCont);
    }

    public function testStoreLimit()
    {
        config()->set('osu.user.max_score_pins', 1);

        $user = User::factory()->create([
            'osu_subscriber' => false,
        ]);
        $score1 = Osu::factory()->create(['user_id' => $user]);
        $score2 = Osu::factory()->create(['user_id' => $user]);
        $pin1 = ScorePin::factory()->withScore($score1, 'score')->create();

        $initialPinCont = ScorePin::count();

        $this->actAsUser($user, true);

        $this
            ->post(route('score-pins.store'), $this->makeParams($score2))
            ->assertStatus(403);

        $this->assertSame(ScorePin::count(), $initialPinCont);
    }

    public function testStoreLimitDifferentMode()
    {
        config()->set('osu.user.max_score_pins', 1);

        $user = User::factory()->create([
            'osu_subscriber' => false,
        ]);
        $score1 = Osu::factory()->create(['user_id' => $user]);
        $score2 = Taiko::factory()->create(['user_id' => $user]);
        $pin1 = ScorePin::factory()->withScore($score1, 'score')->create();

        $initialPinCont = ScorePin::count();

        $this->actAsUser($user, true);

        $this
            ->post(route('score-pins.store'), $this->makeParams($score2))
            ->assertSuccessful();

        $this->assertSame(ScorePin::count(), $initialPinCont + 1);
    }

    private function makeParams($score)
    {
        return [
            'score_id' => $score->getKey(),
            'score_type' => $score->getMorphClass(),
        ];
    }
}
