<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Exceptions\InvariantException;
use App\Libraries\Multiplayer\Ruleset;
use Tests\TestCase;

class ModsTest extends TestCase
{
    public function testModSettings()
    {
        $settings = app('mods')->filterSettings(Ruleset::OSU, 'WU', ['initial_rate' => '1']);

        $this->assertSame(1.0, $settings->initial_rate);
    }

    public function testModSettingsInvalid()
    {
        $this->expectException(InvariantException::class);
        app('mods')->filterSettings(Ruleset::OSU, 'WU', ['x' => '1']);
    }

    public function testParseInputArray()
    {
        $input = [['acronym' => 'WU', 'settings' => []]];
        $parsed = app('mods')->parseInputArray(Ruleset::OSU, $input);

        $this->assertSame(1, count($parsed));
        $this->assertSame(0, count((array) $parsed[0]->settings));
        $this->assertSame('WU', $parsed[0]->acronym);
    }

    public function testParseInputArrayInvalidMod()
    {
        $input = [['acronym' => 'XYZ', 'settings' => []]];

        $this->expectException(InvariantException::class);
        app('mods')->parseInputArray(Ruleset::OSU, $input);
    }

    public function testParseInputArrayWithSettings()
    {
        $input = [['acronym' => 'WU', 'settings' => ['initial_rate' => '1', 'adjust_pitch' => false]]];
        $parsed = app('mods')->parseInputArray(Ruleset::OSU, $input);

        $this->assertSame(1, count($parsed));
        $this->assertSame(2, count((array) $parsed[0]->settings));
        $this->assertSame(1.0, $parsed[0]->settings->initial_rate);
        $this->assertSame(false, $parsed[0]->settings->adjust_pitch);
        $this->assertSame('WU', $parsed[0]->acronym);
    }

    public function testParseInputArrayWithSettingsInvalid()
    {
        $input = [['acronym' => 'WU', 'settings' => ['x' => '1']]];

        $this->expectException(InvariantException::class);
        app('mods')->parseInputArray(Ruleset::OSU, $input);
    }

    public function testValidateSelectionWithInvalidRuleset()
    {
        $this->expectException(InvariantException::class);
        app('mods')->validateSelection(-1, []);
    }

    /**
     * @dataProvider modComboExclusives
     */
    public function testAssertValidExclusivity($rulesetId, $requiredIds, $allowedIds, $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvariantException::class);
        }

        $result = app('mods')->assertValidExclusivity($rulesetId, $requiredIds, $allowedIds);

        if ($isValid) {
            $this->assertTrue($result);
        }
    }

    /**
     * @dataProvider modCombos
     */
    public function testValidateSelection($rulesetId, $modCombo, $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvariantException::class);
        }

        $result = app('mods')->validateSelection($rulesetId, $modCombo);

        if ($isValid) {
            $this->assertTrue($result);
        }
    }

    public function modCombos()
    {
        return [
            // valid
            [Ruleset::OSU, ['HD', 'DT'], true],
            [Ruleset::OSU, ['HD', 'HR'], true],
            [Ruleset::OSU, ['HD', 'HR'], true],
            [Ruleset::OSU, ['HD', 'NC'], true],

            [Ruleset::TAIKO, ['HD', 'NC'], true],
            [Ruleset::TAIKO, ['HD', 'DT'], true],
            [Ruleset::TAIKO, ['HD', 'HR'], true],
            [Ruleset::TAIKO, ['HR', 'PF'], true],
            [Ruleset::TAIKO, ['RD', 'SD'], true],

            [Ruleset::CATCH, ['HD', 'HR'], true],
            [Ruleset::CATCH, ['HD', 'PF'], true],
            [Ruleset::CATCH, ['HD', 'SD'], true],
            [Ruleset::CATCH, ['HD'], true],
            [Ruleset::CATCH, ['EZ'], true],

            [Ruleset::MANIA, ['DT', 'PF'], true],
            [Ruleset::MANIA, ['NC', 'SD'], true],
            [Ruleset::MANIA, ['6K', 'HD'], true],
            [Ruleset::MANIA, ['4K', 'HT'], true],

            // invalid
            [Ruleset::OSU, ['5K'], false],
            [Ruleset::OSU, ['DS'], false],
            [Ruleset::OSU, ['HD', 'HD'], false],

            [Ruleset::TAIKO, ['AP'], false],

            [Ruleset::CATCH, ['4K'], false],
            [Ruleset::CATCH, ['AP'], false],

            [Ruleset::MANIA, ['AP'], false],
        ];
    }

    public function modComboExclusives()
    {
        return [
            // non-exclusive required mods and no allowed mods
            [Ruleset::OSU, ['HD', 'NC'], [], true],
            [Ruleset::MANIA, ['DT', 'PF'], [], true],

            // no conflicting exclusive required mods and allowed mods
            [Ruleset::OSU, ['HD'], ['NC'], true],
            [Ruleset::MANIA, ['DT'], ['PF'], true],

            // conflicting exclusive required mods
            [Ruleset::OSU, ['RX', 'PF'], [], false],
            [Ruleset::MANIA, ['FI', 'HD'], [], false],

            // allowed mods conflicts with exclusive required mods
            [Ruleset::OSU, ['RX'], ['PF'], false],
            [Ruleset::TAIKO, ['RX'], ['PF'], false],
        ];
    }
}
