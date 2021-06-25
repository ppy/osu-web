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
        $beatmapset = factory(Beatmapset::class)->create();

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]))
            ->assertStatus(200);
    }

    public function testBeatmapsetIsNotActive()
    {
        $beatmapset = factory(Beatmapset::class)->states('inactive')->create();

        $this->get(route('beatmapsets.show', ['beatmapset' => $beatmapset->getKey()]))
            ->assertStatus(404);
    }

    public function testBeatmapsetNominate()
    {
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = $this->createUserWithGroupPlaymodes('bng', [$beatmap->mode]);

        $this->actingAsVerified($nominator)
            ->put(route('beatmapsets.nominate', ['beatmapset' => $beatmapset->getKey(), 'playmodes' => [$beatmap->mode]]))
            ->assertSuccessful();

        $this->assertSame(1, $beatmapset->nominationsSinceReset()->count());
    }

    public function testBeatmapsetNominateOwnBeatmapset()
    {
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = $this->createUserWithGroupPlaymodes('bng', [$beatmap->mode]);

        $beatmapset->update(['user_id' => $nominator->getKey()]);

        $this->actingAsVerified($nominator)
            ->put(route('beatmapsets.nominate', ['beatmapset' => $beatmapset->getKey(), 'playmodes' => [$beatmap->mode]]))
            ->assertStatus(403);

        $this->assertSame(0, $beatmapset->nominationsSinceReset()->count());
    }

    public function testBeatmapsetNominateOwnBeatmap()
    {
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
        ]);
        $beatmap = factory(Beatmap::class)->create(['beatmapset_id' => $beatmapset->getKey()]);
        $nominator = $this->createUserWithGroupPlaymodes('bng', [$beatmap->mode]);

        $beatmap->update(['user_id' => $nominator->getKey()]);

        $this->actingAsVerified($nominator)
            ->put(route('beatmapsets.nominate', ['beatmapset' => $beatmapset->getKey(), 'playmodes' => [$beatmap->mode]]))
            ->assertStatus(403);

        $this->assertSame(0, $beatmapset->nominationsSinceReset()->count());
    }

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsModerator($state)
    {
        $owner = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner->getKey(),
        ]);
        $newGenre = factory(Genre::class)->create();
        $newLanguage = factory(Language::class)->create();

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
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner->getKey(),
        ]);
        $newGenre = factory(Genre::class)->create();
        $newLanguage = factory(Language::class)->create();

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
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner->getKey(),
        ]);
        $newGenre = factory(Genre::class)->create();
        $newLanguage = factory(Language::class)->create();

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

    public function testBeatmapsetUpdateOffsetDifferent()
    {
        $owner = factory(User::class)->create();

        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $owner->getKey(),
        ]);

        $lastEventBeforeTry = BeatmapsetEvent::orderBy('created_at', 'desc')->first();
        $newOffset = 25;

        $this->actingAsVerified($owner)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'offset' => $newOffset,
                ],
            ])->assertStatus(200);

        $beatmapset->refresh();

        $this->assertSame($newOffset, $beatmapset->offset);
        $this->assertNotSame(BeatmapsetEvent::orderBy('created_at', 'desc')->first(), $lastEventBeforeTry);
    }

    public function testBeatmapsetUpdateOffsetSame()
    {
        $owner = factory(User::class)->create();
        $beatmapset = factory(Beatmapset::class)->create([
            'approved' => Beatmapset::STATES['pending'],
            'user_id' => $owner->getKey(),
        ]);

        $lastEventBeforeTry = BeatmapsetEvent::orderBy('created_at', 'desc')->first();
        $oldOffset = $beatmapset->offset;

        $this->actingAsVerified($owner)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'offset' => $beatmapset->offset,
                ]
            ])->assertStatus(200);

        $beatmapset->refresh();

        $this->assertSame($oldOffset, $beatmapset->offset);
        $this->assertSame(BeatmapsetEvent::orderBy('created_at', 'desc')->first(), $lastEventBeforeTry);
    }

    public function beatmapsetStatesDataProvider()
    {
        return array_map(function ($state) {
            return [$state];
        }, array_keys(Beatmapset::STATES));
    }
}
