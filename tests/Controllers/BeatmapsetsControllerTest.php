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

        $moderator = User::factory()->withGroup('nat')->create();

        $resultGenreId = $newGenre->getKey();
        $resultLanguageId = $newLanguage->getKey();

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 2);

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
        $owner = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();

        $resultGenreId = $beatmapset->genre_id;
        $resultLanguageId = $beatmapset->language_id;

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), 0);

        $user = User::factory()->create();

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
     * @dataProvider dataProviderForTestBeatmapsetUpdateDescriptionAsOwner
     */
    public function testBeatmapsetUpdateDescriptionAsOwner(bool $downloadDisabled, ?string $downloadDisabledUrl, bool $ok)
    {
        $beatmapset = Beatmapset::factory()->owner()->withDescription()->create([
            'download_disabled' => $downloadDisabled,
            'download_disabled_url' => $downloadDisabledUrl,
        ]);
        $owner = $beatmapset->user;
        $beatmapset->updateDescription('old description', $owner);

        $newDescription = 'new description';
        $expectedDescription = $ok ? $newDescription : $beatmapset->editableDescription();

        $this->actingAsVerified($owner)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'description' => $newDescription,
            ])->assertStatus($ok ? 200 : 403);

        $beatmapset->refresh();

        $this->assertSame($expectedDescription, $beatmapset->editableDescription());
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

        $resultGenreId = $ok ? $newGenre->getKey() : $beatmapset->genre_id;
        $resultLanguageId = $ok ? $newLanguage->getKey() : $beatmapset->language_id;

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), $ok ? 2 : 0);

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

    /**
     * @dataProvider beatmapsetStatesDataProvider
     */
    public function testBeatmapsetUpdateMetadataAsProjectLoved(string $state): void
    {
        $owner = User::factory()->create();
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES[$state],
            'user_id' => $owner,
        ]);
        $newGenre = Genre::factory()->create();
        $newLanguage = Language::factory()->create();

        if (in_array($state, ['graveyard', 'loved'], true)) {
            $countChange = 2;
            $status = 200;
            $resultGenreId = $newGenre->getKey();
            $resultLanguageId = $newLanguage->getKey();
        } else {
            $countChange = 0;
            $status = 403;
            $resultGenreId = $beatmapset->genre_id;
            $resultLanguageId = $beatmapset->language_id;
        }
        $this->expectCountChange(fn () => BeatmapsetEvent::count(), $countChange);

        $user = User::factory()->withGroup('loved')->create();

        $this->actingAsVerified($user)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'genre_id' => $newGenre->getKey(),
                    'language_id' => $newLanguage->getKey(),
                ],
            ])->assertStatus($status);

        $beatmapset->refresh();

        $this->assertSame($resultGenreId, $beatmapset->genre_id);
        $this->assertSame($resultLanguageId, $beatmapset->language_id);
    }

    /**
     * @dataProvider dataProviderForTestBeatmapsetUpdateOffset
     */
    public function testBeatmapsetUpdateOffset(string $userGroupOrOwner, bool $ok): void
    {
        $beatmapset = Beatmapset::factory()->create([
            'approved' => Beatmapset::STATES['ranked'],
        ]);

        $user = $userGroupOrOwner === 'owner'
            ? $beatmapset->user
            : User::factory()->withGroup($userGroupOrOwner)->create();

        $newOffset = $beatmapset->offset + 25;
        $expectedOffset = $ok ? $newOffset : $beatmapset->offset;

        $this->expectCountChange(fn () => BeatmapsetEvent::count(), $ok ? 1 : 0);

        $this->actingAsVerified($user)
            ->put(route('beatmapsets.update', ['beatmapset' => $beatmapset->getKey()]), [
                'beatmapset' => [
                    'offset' => $newOffset,
                ],
            ])->assertStatus($ok ? 200 : 403);

        $beatmapset->refresh();

        $this->assertSame($expectedOffset, $beatmapset->offset);
    }

    public function beatmapsetStatesDataProvider()
    {
        return array_map(function ($state) {
            return [$state];
        }, array_keys(Beatmapset::STATES));
    }

    public function dataProviderForTestBeatmapsetUpdateOffset(): array
    {
        return [
            ['admin', true],
            ['bng', false],
            ['default', false],
            ['gmt', false],
            ['nat', false],
            ['owner', false],
        ];
    }

    public function dataProviderForTestBeatmapsetUpdateDescriptionAsOwner(): array
    {
        return [
            [false, null, true],
            [true, null, false],
            [false, 'https://fail.works/notice', false],
            [true, 'https://fail.works/notice', false],
        ];
    }
}
