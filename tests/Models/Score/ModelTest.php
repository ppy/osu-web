<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Score;

use App\Exceptions\ClassNotFoundException;
use App\Models\Beatmap;
use App\Models\Score\Model;
use Tests\TestCase;

class ModelTest extends TestCase
{
    public function testGetClass(): void
    {
        foreach (Beatmap::MODES as $ruleset => $_rulesetId) {
            $class = Model::getClass($ruleset);
            $this->assertInstanceOf(Model::class, new $class());
        }
    }

    /**
     * @dataProvider dataProviderForTestGetClassInvalidRuleset
     */
    public function testGetClassInvalidRuleset(string $ruleset)
    {
        $this->expectException(ClassNotFoundException::class);
        Model::getClass($ruleset);
    }

    public function dataProviderForTestGetClassInvalidRuleset(): array
    {
        return [
            ['does'],
            ['not exist'],
            ['not_real'],
            ['best\\_osu'],
        ];
    }
}
