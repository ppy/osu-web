<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests\Controllers;

use App\Models\Beatmapset;
use Tests\TestCase;

class BeatmapsetControllerTest extends TestCase
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
}
