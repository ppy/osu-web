<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapsetEvent;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetsControllerTest extends TestCase
{
    public function testBeatmapsetIsActive()
    {
        $beatmap = Beatmap::factory()->create();

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmap->beatmapset_id]))
            ->assertStatus(200);
    }

    public function testBeatmapsetIsNotActive()
    {
        $beatmap = Beatmap::factory()->create([
            'beatmapset_id' => Beatmapset::factory()->inactive(),
        ]);

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmap->beatmapset_id]))
            ->assertStatus(404);
    }

    public function testBeatmapsetWithDeletedBeatmap()
    {
        $beatmap = Beatmap::factory()->create([
            'beatmapset_id' => Beatmapset::factory(),
            'deleted_at' => now(),
        ]);

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmap->beatmapset_id]))
            ->assertStatus(404);
    }

    public function testBeatmapsetWithNoBeatmaps()
    {
        $beatmapset = Beatmapset::factory()->create();

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]))
            ->assertStatus(404);
    }

    public function testBeatmapsetNominate()
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = User::factory()->withGroup('bng', [$beatmap->mode])->create();

        $this->actingAsVerified($nominator)
            ->put(route('beatmapsets.nominate', ['beatmapset' => $beatmapset->getKey(), 'playmodes' => [$beatmap->mode]]))
            ->assertSuccessful();

        $this->assertSame(1, $beatmapset->beatmapsetNominations()->current()->count());
    }

    public function testBeatmapsetNominateOwnBeatmapset()
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = User::factory()->withGroup('bng', [$beatmap->mode])->create();

        $beatmapset->update(['user_id' => $nominator->getKey()]);

        $this->actingAsVerified($nominator)
            ->put(route('beatmapsets.nominate', ['beatmapset' => $beatmapset->getKey(), 'playmodes' => [$beatmap->mode]]))
            ->assertStatus(403);

        $this->assertSame(0, $beatmapset->beatmapsetNominations()->current()->count());
    }

    public function testBeatmapsetNominateOwnBeatmap()
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = User::factory()->withGroup('bng', [$beatmap->mode])->create();

        $beatmap->update(['user_id' => $nominator->getKey()]);

        $this->actingAsVerified($nominator)
            ->put(route('beatmapsets.nominate', ['beatmapset' => $beatmapset->getKey(), 'playmodes' => [$beatmap->mode]]))
            ->assertStatus(403);

        $this->assertSame(0, $beatmapset->beatmapsetNominations()->current()->count());
    }

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsModerator($state)
    {
        $owner = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();
        $newOffset = $beatmapset->offset + 25;

        $moderator = User::factory()->withGroup('nat')->create();

        $resultGenreId = $newGenre->getKey();
        $resultLanguageId = $newLanguage->getKey();

        $eventCountBeforeTry = BeatmapsetEvent::count();

        $this->actingAsVerified($moderator)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                    'offset' => $newOffset,
                ],
            ])->assertSuccessful();

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
        $this->assertSame($newOffset, $beatmapset->offset);
        $this->assertSame(BeatmapsetEvent::count(), $eventCountBeforeTry + 3);
    }

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsOtherUser($state)
    {
        $owner = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();
        $newOffset = $beatmapset->offset + 25;

        $resultGenreId = $beatmapset->genre_id;
        $resultLanguageId = $beatmapset->language_id;
        $resultOffset = $beatmapset->offset;

        $eventCountBeforeTry = BeatmapsetEvent::count();

        $user = User::factory()->create();

        $this->actingAsVerified($user)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                    'offset' => $newOffset,
                ],
            ])->assertStatus(403);

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
        $this->assertSame($resultOffset, $beatmapset->offset);
        $this->assertSame(BeatmapsetEvent::count(), $eventCountBeforeTry);
    }

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsOwner($state)
    {
        $ok = in_array($state, ['graveyard', 'wip', 'pending'], true);

        $owner = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();
        $newOffset = $beatmapset->offset + 25;

        $resultGenreId = $ok ? $newGenre->getKey() : $beatmapset->genre_id;
        $resultLanguageId = $ok ? $newLanguage->getKey() : $beatmapset->language_id;
        $resultOffset = $ok ? $newOffset : $beatmapset->offset;

        $eventCountBeforeTry = BeatmapsetEvent::count();

        $this->actingAsVerified($owner)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                    'offset' => $newOffset,
                ],
            ])->assertStatus($ok ? 200 : 403);

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
        $this->assertSame($resultOffset, $beatmapset->offset);
        $this->assertSame(BeatmapsetEvent::count(), $ok ? $eventCountBeforeTry + 3 : $eventCountBeforeTry);
    }

    public function beatmapsetStatesDataProvider()
    {
        return array_map(function ($state) {
            return [$state];
        }, array_keys(Beatmapset::STATES));
    }
}
