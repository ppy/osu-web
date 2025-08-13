<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search\BeatmapsetSearch;

use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\BeatmapTag;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Collection;

class TagsFilterTest extends TestCase
{
    // some tag names picked because the words can realistically be in other fields.
    private const TAG_NAMES = [
        'aim/aim control',
        'aim/flow',
        'aim/triangles',
        'geometic/grid snap',
        'meta/variable timing',
        'meta/marathon',
        'meta/mega marathon',
        'meta/mega collab',
        'skillset/tech',
        'streams/cutstreams',
        'style/messy',
        'style/geometric',
        'style/old-style revival',
        'style/high contrast',
        'tap/finger control',
        'tap/streams',
        'tech/complex sv',
        'tech/slider tech',
    ];

    private static Collection $tags;
    private static int $tagUserId;

    public static function dataProvider(): array
    {
        return [
            [['q' => 'triangles'], [0, 1, 3]],
            [['q' => '-triangles'], [2, 3]],
            [['q' => 'triangles -revival'], [0, 3]],

            [['q' => 'tag=triangles'], [3]],
            [['q' => 'tag=aim'], [1, 3]],
            [['q' => 'tag=tech'], [0, 2]],

            [['q' => 'tag="style marathon"'], [2]], // should have style AND marathon, different tags accepted.
            [['q' => 'tag="\"style marathon\""'], []], // "style marathon" must be in the same tag
            [['q' => 'tag=style tag=marathon'], [2]], // should have style AND marathon, different tags accepted.

            // phrase match; same tag, in order.
            [['q' => 'tag="\"meta marathon\""'], [0]],
            [['q' => 'tag="\"marathon meta\""'], []],
            [['q' => 'tag="\"mega marathon\""'], [2]],
            [['q' => 'tag="\"marathon mega\""'], []],
            [['q' => 'tag="\"meta mega\""'], [1, 2]],

            [['q' => 'tag=style tag="meta marathon"'], [2]],
            [['q' => 'tag=tech tag="meta marathon"'], [0, 2]],
            [['q' => 'tag=tech tag="\"meta marathon\""'], [0]],

            // explicitly match a tag, double quoting not required.
            [['q' => 'tag="meta/marathon"'], [0]],
            [['q' => 'tag="style/old-style revival"'], [2]],
            [['q' => 'tag="style/old-style"'], []],
            [['q' => 'tag="\"style old-style\""'], [2]],

            // tag="style \"meta marathon\"" is not a valid parser output and not tested.

            [['q' => '-tag=marathon'], [1, 3]],
            [['q' => '-tag=meta'], [3]],
            [['q' => '-tag=tech'], [1, 3]],
            [['q' => '-tag="style marathon"'], [0, 1, 3]], // exclude style AND marathon
            [['q' => '-tag=style -tag=marathon'], [3]], // exclude style OR marathon

            [['q' => '-tag="\"meta mega\""'], [0, 3]],
            [['q' => '-tag="\"meta mega marathon\""'], [0, 1, 3]],
            [['q' => '-tag="\"meta marathon\""'], [1, 2, 3]],
            [['q' => '-tag="meta/marathon"'], [1, 2, 3]],
            [['q' => '-tag="style/old-style revival"'], [0, 1, 3]],
            [['q' => '-tag="style/old-style"'], [0, 1, 2, 3]],
            [['q' => '-tag="\"style old-style\""'], [0, 1, 3]],
        ];
    }

    public static function setUpBeforeClass(): void
    {
        static::withDbAccess(function () {
            \DB::transaction(function () {
                static::$tagUserId = User::factory()->create()->getKey();
                static::$tags = Tag::factory()->count(count(static::TAG_NAMES))->state(new Sequence(fn (Sequence $sequence) => [
                    'name' => static::TAG_NAMES[$sequence->index],
                ]))->create()->keyBy('name');

                $factory = Beatmapset::factory()->ranked();
                static::$beatmapsets = [
                    $factory
                        ->has(static::beatmapWithTags('tech/slider tech', 'meta/marathon', 'tap/streams'))
                        ->create(['title' => 'Triangles']),
                    $factory
                        ->has(static::beatmapWithTags('aim/flow', 'style/high contrast', 'meta/variable timing', 'meta/mega collab'))
                        ->create(['title' => 'Triangles Revival']),
                    $factory
                        ->has(static::beatmapWithTags('style/old-style revival', 'skillset/tech', 'meta/mega marathon'))
                        ->create(['title' => 'Aim for the bottom!']),
                    $factory
                        ->has(static::beatmapWithTags('aim/flow', 'aim/triangles', 'geometic/grid snap'))
                        ->create(['title' => 'high tech flow control']),
                ];
            });
        });

        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        static::withDbAccess(function () {
            BeatmapTag::truncate();
            Tag::truncate();
        });
    }

    private static function beatmapWithTags(...$names): Factory
    {
        $factory = Beatmap::factory()->ranked()->ruleset('osu');

        foreach ($names as $name) {
            $factory = $factory->withTag(static::$tags[$name], static::$tagUserId);
        }

        return $factory;
    }
}
