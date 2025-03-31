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

    public static function dataProviderForUpdate(): array
    {
        return [
            [0, null, true],
            [0, 0, true],
            [0, 1, false],
        ];
    }

    public function testDestroy(): void
    {
        $beatmapTag = BeatmapTag::factory()->create([
            'tag_id' => $this->tag,
            'beatmap_id' => $this->beatmap,
        ]);

        $this->expectCountChange(fn () => BeatmapTag::count(), -1);

        $this->actAsScopedUser($beatmapTag->user);
        $this
            ->delete(route('api.beatmaps.tags.destroy', ['beatmap' => $this->beatmap->getKey(), 'tag' => $this->tag->getKey()]))
            ->assertSuccessful();
    }

     /**
     * @dataProvider dataProviderForUpdate
     */
    public function testUpdate(int $beatmapRulesetId, ?int $tagRulesetId, bool $successful): void
    {
        $tag = Tag::factory()->state(['ruleset_id' => $tagRulesetId])->create();
        $beatmap = Beatmap::factory()->state(['playmode' => $beatmapRulesetId])->create();

        $user = User::factory()
            ->has(Score::factory()->state(['beatmap_id' => $beatmap]), 'soloScores')
            ->create();

        $this->expectCountChange(fn () => BeatmapTag::count(), $successful ? 1 : 0);

        $this->actAsScopedUser($user);
        $request = $this->put(route('api.beatmaps.tags.update', ['beatmap' => $beatmap->getKey(), 'tag' => $tag->getKey()]));

        if ($successful) {
            $request->assertSuccessful();
        } else {
            $request->assertStatus(422);
        }
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
        $this->beatmap = Beatmap::factory()->state(['playmode' => 0])->create();
    }
}
