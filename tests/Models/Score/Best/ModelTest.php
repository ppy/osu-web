<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Score\Best;

use App\Models\Beatmap;
use App\Models\Score\Best\Model;
use Tests\TestCase;

class ModelTest extends TestCase
{
    private static function getRandomRuleset(): string
    {
        return array_rand(Beatmap::MODES);
    }

    public function testDelete()
    {
        $class = Model::getClass(static::getRandomRuleset());
        $score = $class::factory()->create();

        $this->expectCountChange(fn () => $class::count(), -1);

        $score->delete();
    }
}
