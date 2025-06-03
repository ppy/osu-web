<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\ScorePin;
use App\Models\Solo\Score;
use App\Models\User;
use Tests\TestCase;

class ScorePinsControllerTest extends TestCase
{
    private static function createScore(?User $user = null, ?int $rulesetId = null, ?bool $passed = null): Score
    {
        if ($rulesetId !== null) {
            $params['ruleset_id'] = $rulesetId;
        }
        if ($user !== null) {
            $params['user_id'] = $user;
        }
        $params['passed'] = $passed ?? true;

        return Score::factory()->create($params);
    }

    private static function makeParams(Score $score): array
    {
        return [
            'score_id' => $score->getKey(),
        ];
    }

    public function testDestroy()
    {
        $pin = ScorePin::factory()->withScore(static::createScore())->create();

        $this->expectCountChange(fn () => ScorePin::count(), -1);

        $this->actAsUser($pin->user, true);

        $this
            ->delete(route('score-pins.destroy', $pin->score))
            ->assertSuccessful();
    }

    public function testDestroyAsDifferentUser()
    {
        $pin = ScorePin::factory()->withScore(static::createScore())->create();
        $otherUser = User::factory()->create();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this->actAsUser($otherUser, true);

        $this
            ->delete(route('score-pins.destroy', $pin->score))
            ->assertSuccessful();
    }

    public function testDestroyAsGuest()
    {
        $pin = ScorePin::factory()->withScore(static::createScore())->create();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this
            ->delete(route('score-pins.destroy', $pin->score))
            ->assertStatus(401);
    }

    // moving: [0]. expected order: [1] < [0]
    public function testReorderMoveBottom()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(static::createScore($user, Beatmap::MODES['osu']))
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder', $pins[0]->score), [
                'order1_score_id' => $pins[1]->score->getKey(),
            ])->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[1]->display_order < $pins[0]->display_order);
    }

    // moving: [0]. expected order: [1] < [0] < [2]
    public function testReorderMoveDown()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1, 2])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(static::createScore($user, Beatmap::MODES['osu']))
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder', $pins[0]->score), [
                'order1_score_id' => $pins[1]->score->getKey(),
            ])->assertSuccessful();

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
            ->withScore(static::createScore($user, Beatmap::MODES['osu']))
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder', $pins[1]->score), [
                'order3_score_id' => $pins[0]->score->getKey(),
            ])->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[1]->display_order < $pins[0]->display_order);
    }

    // moving: [2]. expected order: [0] < [2] < [1]
    public function testReorderMoveUp()
    {
        $user = User::factory()->create();
        $pins = collect([0, 1, 2])->map(fn ($order) => ScorePin
            ::factory(['display_order' => $order])
            ->withScore(static::createScore($user, Beatmap::MODES['osu']))
            ->create());

        $this->actAsUser($user, true);
        $this
            ->put(route('score-pins.reorder', $pins[2]->score), [
                'order1_score_id' => $pins[0]->score->getKey(),
            ])->assertSuccessful();

        $pins->map->refresh();
        $this->assertTrue($pins[0]->display_order < $pins[2]->display_order);
        $this->assertTrue($pins[2]->display_order < $pins[1]->display_order);
    }

    public function testStore()
    {
        $score = static::createScore();

        $this->expectCountChange(fn () => $score->user->scorePins()->count(), 1);

        $this->actAsUser($score->user, true);

        $this
            ->post(route('score-pins.store', $score))
            ->assertSuccessful();
    }

    public function testStoreAsGuest()
    {
        $score = static::createScore();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this
            ->post(route('score-pins.store', $score))
            ->assertStatus(401);
    }

    public function testStoreAsNonOwner()
    {
        $score = static::createScore();
        $otherUser = User::factory()->create();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this->actAsUser($otherUser, true);

        $this
            ->post(route('score-pins.store', $score))
            ->assertStatus(403);
    }

    // new score pin should always be above existing ones
    public function testStoreDisplayOrder()
    {
        $user = User::factory()->create([
            'osu_subscriber' => false,
        ]);
        $score1 = static::createScore($user, Beatmap::MODES['osu']);
        $score2 = static::createScore($user, Beatmap::MODES['osu']);
        $pin1 = ScorePin::factory()->withScore($score1)->create();

        $this->actAsUser($user, true);

        $this
            ->post(route('score-pins.store', $score2))
            ->assertSuccessful();

        $pin2 = $user->scorePins()->find($score2->getKey());
        $this->assertTrue($pin1->display_order > $pin2->display_order);
    }

    public function testStoreDuplicate()
    {
        $score = static::createScore();
        $pin = ScorePin::factory()->withScore($score)->create();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this->actAsUser($score->user, true);

        $this
            ->post(route('score-pins.store', $score))
            ->assertSuccessful();
    }

    public function testStoreInvalidScoreId()
    {
        Score::whereKey(1)->delete();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this->actAsUser(User::factory()->create(), true);

        $this
            ->post(route('score-pins.store', ['score' => 1]))
            ->assertStatus(422);
    }

    public function testStoreLimit()
    {
        config_set('osu.user.max_score_pins', 1);

        $user = User::factory()->create([
            'osu_subscriber' => false,
        ]);
        $score1 = static::createScore($user, Beatmap::MODES['osu']);
        $score2 = static::createScore($user, Beatmap::MODES['osu']);
        $pin1 = ScorePin::factory()->withScore($score1)->create();

        $this->expectCountChange(fn () => ScorePin::count(), 0);

        $this->actAsUser($user, true);

        $this
            ->post(route('score-pins.store', $score2))
            ->assertStatus(403);
    }

    public function testStoreLimitDifferentMode()
    {
        config_set('osu.user.max_score_pins', 1);

        $user = User::factory()->create([
            'osu_subscriber' => false,
        ]);
        $score1 = static::createScore($user, Beatmap::MODES['osu']);
        $score2 = static::createScore($user, Beatmap::MODES['taiko']);
        $pin1 = ScorePin::factory()->withScore($score1)->create();

        $this->expectCountChange(fn () => ScorePin::count(), 1);

        $this->actAsUser($user, true);

        $this
            ->post(route('score-pins.store', $score2))
            ->assertSuccessful();
    }
}
