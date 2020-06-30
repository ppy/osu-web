<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use Tests\TestCase;

class RankingControllerTest extends TestCase
{
    public function testIndex()
    {
        $this
            ->get(route('rankings', ['mode' => 'osu', 'type' => 'performance']))
            ->assertSuccessful();
    }

    public function testIndexRedirect()
    {
        $this
            ->get(route('rankings', ['mode' => 'osu']))
            ->assertRedirect(route('rankings', ['mode' => 'osu', 'type' => 'performance']));
    }

    public function testIndexInvalidMode()
    {
        $this
            ->get(route('rankings', ['mode' => 'nope', 'type' => 'performance']))
            ->assertStatus(404);
    }

    public function testIndexInvalidType()
    {
        $this
            ->get(route('rankings', ['mode' => 'osu', 'type' => 'notatype']))
            ->assertStatus(404);
    }
}
