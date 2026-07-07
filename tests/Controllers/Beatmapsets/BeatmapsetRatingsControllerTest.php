<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Beatmapsets;

use App\Models\Beatmapset;
use App\Models\BeatmapsetUserRating;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetRatingsControllerTest extends TestCase
{
    public function testStore()
    {
        $beatmapset = Beatmapset::factory()->create(['approved' => 1]);
        $firstUser = User::factory()->create();
        $secondUser = User::factory()->create();

        $this->expectCountChange(fn () => $beatmapset->userRatings()->count(), 2);

        $this->actAsScopedUser($firstUser);
        $request = $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 2]
        );

        $request->assertSuccessful()
            ->assertJson(['updated_rating' => 2]);
        $beatmapset->refresh();
        $this->assertEquals(2, $beatmapset->rating);

        $this->actAsScopedUser($secondUser);
        $request = $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 5]
        );

        $request->assertSuccessful()
            ->assertJson(['updated_rating' => 3.5]);
        $beatmapset->refresh();
        $this->assertEquals(3.5, $beatmapset->rating);
    }

    public function testStoreFailsIfBeatmapsetUnranked()
    {
        $beatmapset = Beatmapset::factory()->create(['approved' => 0]);
        $user = User::factory()->create();

        $this->actAsScopedUser($user);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 2]
        )->assertStatus(422)
            ->assertJson(['error' => 'Cannot rate this beatmap set.']);
    }

    /**
     * @dataProvider dataProviderForInvalidRatings
     */
    public function testStoreFailsIfRatingInvalid($rating)
    {
        $beatmapset = Beatmapset::factory()->create(['approved' => 1]);
        $user = User::factory()->create();

        $this->actAsScopedUser($user);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => $rating]
        )->assertStatus(422)
            ->assertJson(['error' => 'Invalid rating.']);
    }

    public function testStoreFailsIfUserAlreadyRated()
    {
        $beatmapset = Beatmapset::factory()->create(['approved' => 1]);
        $user = User::factory()->create();
        BeatmapsetUserRating::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $user->getKey(),
            'rating' => 8,
        ]);

        $this->actAsScopedUser($user);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 2]
        )->assertStatus(422)
            ->assertJson(['error' => "You've already rated this beatmap set."]);
    }

    public static function dataProviderForInvalidRatings(): array
    {
        return [
            'not a number' => ['hax'],
            'negative' => [-5],
            'too low' => [0],
            'too high' => [11],
        ];
    }
}
