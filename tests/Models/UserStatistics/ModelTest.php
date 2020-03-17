<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\UserStatistics;

use App\Exceptions\ClassNotFoundException;
use App\Models\Beatmap;
use App\Models\UserStatistics\Model;
use Tests\TestCase;

class ModelTest extends TestCase
{
    public function testGetClass()
    {
        $modes = array_keys(Beatmap::MODES);
        foreach ($modes as $mode) {
            $class = Model::getClass($mode);
            $this->assertInstanceOf(Model::class, new $class);
        }
    }

    /**
     * @dataProvider modes
     */
    public function testGetClassByThrowsExceptionIfModeDoesNotExist($mode)
    {
        $this->expectException(ClassNotFoundException::class);
        Model::getClass($mode);
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
