<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tests;

use App\Exceptions\InvariantException;
use App\Libraries\Multiplayer\Mod;
use App\Libraries\Multiplayer\Ruleset;
use TestCase;

class ModTest extends TestCase
{
    public function testValidForRulesetWithValid()
    {
        // This test feels a bit silly and is more implementation-testing than anything...
        // ...consider it a sanity check I guess?

        foreach (Ruleset::ALL as $ruleset) {
            foreach (Mod::validityByRuleset()[$ruleset] as $mod) {
                $this->assertSame(
                    Mod::validForRuleset($mod, $ruleset),
                    true
                );
            }
        }
    }

    public function testValidForRulesetWithInvalid()
    {
        // osu standard
        // enabling a mania-only mod should fail
        $this->assertSame(
            Mod::validForRuleset('9K', Ruleset::OSU),
            false
        );

        // taiko
        // enabling a osu standard specific mod should fail
        $this->assertSame(
            Mod::validForRuleset('AP', Ruleset::TAIKO),
            false
        );
        // enabling a mania specific mod should fail
        $this->assertSame(
            Mod::validForRuleset('9K', Ruleset::TAIKO),
            false
        );

        // catch
        // enabling a osu standard specific mod should fail
        $this->assertSame(
            Mod::validForRuleset('AP', Ruleset::CATCH),
            false
        );
        // enabling a mania specific mod should fail
        $this->assertSame(
            Mod::validForRuleset('9K', Ruleset::CATCH),
            false
        );

        // mania
        // enabling a osu standard specific mod should fail
        $this->assertSame(
            Mod::validForRuleset('AP', Ruleset::MANIA),
            false
        );
    }

    public function testValidateSelectionWithValid()
    {
        $validModCombos = [
            Ruleset::OSU => [
                ['HD', 'DT'],
                ['HD', 'HR'],
                ['HD', 'HR'],
                ['HD', 'NC'],
            ],

            Ruleset::TAIKO => [
                ['HD', 'NC'],
                ['HD', 'DT'],
                ['HD', 'HR'],
                ['HR', 'PF'],
            ],

            Ruleset::CATCH => [
                ['HD', 'HR'],
                ['HD', 'PF'],
                ['HD', 'SD'],
                ['HD'],
                ['EZ'],
            ],

            Ruleset::MANIA => [
                ['DT', 'PF'],
                ['NC', 'SD'],
                ['6K', 'HD'],
                ['4K', 'HT'],
            ],
        ];

        foreach ($validModCombos as $ruleset => $modCombos) {
            foreach ($modCombos as $modCombo) {
                $this->assertSame(
                    Mod::validateSelection($modCombo, $ruleset),
                    true
                );
            }
        }
    }

    public function testValidateSelectionWithInvalid()
    {
        $invalidModCombos = [
            Ruleset::OSU => [
                ['5K'],
                ['DS'],
                ['HD', 'HD'],
                ['RX', 'PF'],
            ],

            Ruleset::TAIKO => [
                ['AP'],
                ['RD', 'SD'],
                ['RX', 'PF'],
            ],

            Ruleset::CATCH => [
                ['4K'],
                ['AP'],
                ['RX', 'PF'],
            ],

            Ruleset::MANIA => [
                ['AP'],
                ['RD', 'SD'],
                ['RX', 'PF'],
            ],
        ];

        $this->expectException(InvariantException::class);
        foreach ($invalidModCombos as $ruleset => $modCombos) {
            foreach ($modCombos as $modCombo) {
                $this->assertSame(
                    Mod::validateSelection($modCombo, $ruleset),
                    false
                );
            }
        }
    }
}
