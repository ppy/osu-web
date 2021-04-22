<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Solo;

use App\Exceptions\InvariantException;
use App\Models\Solo\Score;
use stdClass;
use Tests\TestCase;

class ScoreTest extends TestCase
{
    public function testCreateLegacyEntryIncompletePlay()
    {
        $score = new Score();

        $this->expectException(InvariantException::class);

        $score->createLegacyEntry();
    }

    public function testModsPropertyType()
    {
        $score = new Score(['mods' => [new stdClass()]]);

        $this->assertTrue($score->mods[0] instanceof stdClass, 'mods entry should be of type stdClass');
    }
}
