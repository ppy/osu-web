<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Genre;
use App\Models\Language;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetsControllerTest extends TestCase
{
    public function testBeatmapsetIsActive()
    {
        $beatmapset = Beatmapset::factory()->create();

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]))
            ->assertStatus(200);
    }

    public function testBeatmapsetIsNotActive()
    {
        $beatmapset = Beatmapset::factory()->inactive()->create();

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]))
            ->assertStatus(404);
    }

    public function testBeatmapsetNominate()
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = Beatmap::factory()->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = $this->createUserWithGroupPlaymodes('bng', [$beatmap->mode]);

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
        $nominator = $this->createUserWithGroupPlaymodes('bng', [$beatmap->mode]);

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
        $nominator = $this->createUserWithGroupPlaymodes('bng', [$beatmap->mode]);

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
        $owner = factory(User::class)->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();

        $moderator = $this->createUserWithGroup('nat');

        $resultGenreId = $newGenre->getKey();
        $resultLanguageId = $newLanguage->getKey();

        $this->actingAsVerified($moderator)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                ],
            ])->assertSuccessful();

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
    }

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsOtherUser($state)
    {
        $owner = factory(User::class)->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();

        $resultGenreId = $beatmapset->genre_id;
        $resultLanguageId = $beatmapset->language_id;

        $user = factory(User::class)->create();

        $this->actingAsVerified($user)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                ],
            ])->assertStatus(403);

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
    }

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsOwner($state)
    {
        $ok = in_array($state, ['graveyard', 'wip', 'pending'], true);

        $owner = factory(User::class)->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();

        $resultGenreId = $ok ? $newGenre->getKey() : $beatmapset->genre_id;
        $resultLanguageId = $ok ? $newLanguage->getKey() : $beatmapset->language_id;

        $this->actingAsVerified($owner)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                ],
            ])->assertStatus($ok ? 200 : 403);

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
    }

    public function beatmapsetStatesDataProvider()
    {
        return array_map(function ($state) {
            return [$state];
        }, array_keys(Beatmapset::STATES));
    }
}
