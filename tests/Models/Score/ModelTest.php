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
    public function testGetClassByString()
    {
        $modes = array_keys(Beatmap::MODES);
        foreach ($modes as $mode) {
            $class = Model::getClassByString($mode);
            $this->assertInstanceOf(Model::class, new $class());
        }
    }

    /**
     * @dataProvider modes
     */
    public function testGetClassByStringThrowsExceptionIfModeDoesNotExist($mode)
    {
        $this->expectException(ClassNotFoundException::class);
        Model::getClassByString($mode);
    }

    public function modes()
    {
        return [
            ['does'],
            ['not exist'],
            ['not_real'],
            ['best\\_osu'],
        ];
    }
}
