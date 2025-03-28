<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Beatmap;
use App\Models\BeatmapTag;
use App\Models\Solo\Score;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class BeatmapTagsControllerTest extends TestCase
{
    private Tag $tag;
    private Beatmap $beatmap;
    private BeatmapTag $beatmapTag;

    public function testDestroy(): void
    {
        $this->expectCountChange(fn () => BeatmapTag::count(), -1);

        $this->actAsScopedUser($this->beatmapTag->user);
        $this
            ->delete(route('api.beatmaps.tags.destroy', ['beatmap' => $this->beatmap->getKey(), 'tag' => $this->tag->getKey()]))
            ->assertSuccessful();
    }

    public function testUpdate(): void
    {
        $user = User::factory()
            ->has(Score::factory()->state(['beatmap_id' => $this->beatmap]), 'soloScores')
            ->create();

        $this->expectCountChange(fn () => BeatmapTag::count(), 1);

        $this->actAsScopedUser($user);
        $this
            ->put(route('api.beatmaps.tags.update', ['beatmap' => $this->beatmap->getKey(), 'tag' => $this->tag->getKey()]))
            ->assertSuccessful();
    }

    public function testUpdateNoScore(): void
    {
        $this->expectCountChange(fn () => BeatmapTag::count(), 0);

        $this->actAsScopedUser(User::factory()->create());
        $this
            ->put(route('api.beatmaps.tags.update', ['beatmap' => $this->beatmap->getKey(), 'tag' => $this->tag->getKey()]))
            ->assertForbidden();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->tag = Tag::factory()->create();
        $this->beatmap = Beatmap::factory()->create();
        $this->beatmapTag = BeatmapTag::factory()->create([
            'tag_id' => $this->tag,
            'beatmap_id' => $this->beatmap,
        ]);
    }
}
