<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers\Beatmapsets;

use App\Models\Beatmapset;
use App\Models\BeatmapsetUserRating;
use App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BeatmapsetRatingsControllerTest extends TestCase
{
    public static function dataProviderForInvalidRatings(): array
    {
        return [
            'not a number' => ['hax'],
            'negative' => [-5],
            'too low' => [0],
            'too high' => [11],
        ];
    }

    public function testIndexForBeatmapOwner()
    {
        $beatmapsetOwner = User::factory()->create();
        $beatmapOwner = User::factory()->create();
        $beatmapset = Beatmapset::factory()
            ->ranked()
            ->owner($beatmapsetOwner)
            ->withBeatmaps('osu', 1, $beatmapOwner)
            ->create(['rating' => 3.43]);

        $this->actAsScopedUser($beatmapOwner);

        $this->get(route('api.beatmapsets.ratings.index', ['beatmapset' => $beatmapset->getKey()]))
            ->assertSuccessful()
            ->assertJson([
                'disallow_rating_reason' => 'You cannot rate a beatmap set you are involved with.',
                'total_rating' => 3.43,
            ]);
    }

    public function testIndexForBeatmapsetOwner()
    {
        $user = User::factory()->create();
        $beatmapset = Beatmapset::factory()
            ->ranked()
            ->owner($user)
            ->create(['rating' => 9.84]);

        $this->actAsScopedUser($user);

        $this->get(route('api.beatmapsets.ratings.index', ['beatmapset' => $beatmapset->getKey()]))
            ->assertSuccessful()
            ->assertJson([
                'disallow_rating_reason' => 'You cannot rate a beatmap set you are involved with.',
                'total_rating' => 9.84,
            ]);
    }

    public function testIndexWithoutUserRating()
    {
        $beatmapset = Beatmapset::factory()->ranked()->create([
            'rating' => 4.37,
        ]);
        $user = User::factory()->create();

        $this->actAsScopedUser($user);

        $this->get(route('api.beatmapsets.ratings.index', ['beatmapset' => $beatmapset->getKey()]))
            ->assertSuccessful()
            ->assertJson([
                'disallow_rating_reason' => null,
                'total_rating' => 4.37,
            ]);
    }

    public function testIndexWithUserRating()
    {
        $beatmapset = Beatmapset::factory()->ranked()->create([
            'rating' => 7.43,
        ]);
        $user = User::factory()->create();
        BeatmapsetUserRating::create([
            'beatmapset_id' => $beatmapset->getKey(),
            'user_id' => $user->getKey(),
            'rating' => 7,
        ]);

        $this->actAsScopedUser($user);

        $this->get(route('api.beatmapsets.ratings.index', ['beatmapset' => $beatmapset->getKey()]))
            ->assertSuccessful()
            ->assertJson([
                'disallow_rating_reason' => null,
                'total_rating' => 7.43,
                'user_rating' => 7,
            ]);
    }

    public function testIndexUnrankedBeatmap()
    {
        $beatmapset = Beatmapset::factory()->pending()->create();
        $user = User::factory()->create();

        $this->actAsScopedUser($user);

        $this->get(route('api.beatmapsets.ratings.index', ['beatmapset' => $beatmapset->getKey()]))
            ->assertSuccessful()
            ->assertJson(['disallow_rating_reason' => 'You cannot rate a beatmap set with this status.']);
    }

    public function testStore()
    {
        $beatmapset = Beatmapset::factory()->ranked()->create();
        $firstUser = User::factory()->create();
        $secondUser = User::factory()->create();

        $this->expectCountChange(fn () => $beatmapset->userRatings()->count(), 2);

        $this->actAsScopedUser($firstUser);
        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 2]
        )->assertSuccessful()
            ->assertJson(['updated_rating' => 2]);
        $beatmapset->refresh();
        $this->assertSame(2.0, $beatmapset->rating);

        $this->actAsScopedUser($secondUser);
        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 5]
        )->assertSuccessful()
            ->assertJson(['updated_rating' => 3.5]);
        $beatmapset->refresh();
        $this->assertSame(3.5, $beatmapset->rating);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 8]
        )->assertSuccessful()
            ->assertJson(['updated_rating' => 5]);
        $beatmapset->refresh();
        $this->assertSame(5.0, $beatmapset->rating);
    }

    public function testStoreFailsIfBeatmapOwnerVotes()
    {
        $beatmapsetOwner = User::factory()->create();
        $beatmapOwner = User::factory()->create();
        $beatmapset = Beatmapset::factory()
            ->ranked()
            ->owner($beatmapsetOwner)
            ->withBeatmaps('osu', 1, $beatmapOwner)
            ->create();

        $this->actAsScopedUser($beatmapOwner);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 10]
        )->assertStatus(403)
            ->assertJson(['error' => 'You cannot rate a beatmap set you are involved with.']);
    }

    public function testStoreFailsIfBeatmapsetOwnerVotes()
    {
        $user = User::factory()->create();
        $beatmapset = Beatmapset::factory()
            ->ranked()
            ->owner($user)
            ->create();

        $this->actAsScopedUser($user);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 10]
        )->assertStatus(403)
            ->assertJson(['error' => 'You cannot rate a beatmap set you are involved with.']);
    }

    public function testStoreFailsIfBeatmapsetUnranked()
    {
        $beatmapset = Beatmapset::factory()->pending()->create();
        $user = User::factory()->create();

        $this->actAsScopedUser($user);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => 2]
        )->assertStatus(403)
            ->assertJson(['error' => 'You cannot rate a beatmap set with this status.']);
    }

    #[DataProvider('dataProviderForInvalidRatings')]
    public function testStoreFailsIfRatingInvalid($rating)
    {
        $beatmapset = Beatmapset::factory()->ranked()->create();
        $user = User::factory()->create();

        $this->actAsScopedUser($user);

        $this->post(
            route('api.beatmapsets.ratings.store', ['beatmapset' => $beatmapset->getKey()]),
            ['rating' => $rating]
        )->assertStatus(422)
            ->assertJson(['error' => 'Invalid rating.']);
    }
}
