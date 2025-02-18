<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Singletons;

use App\Enums\Ruleset;
use App\Exceptions\InvariantException;
use Tests\TestCase;

class ModsTest extends TestCase
{
    public function testModSettings()
    {
        $settings = app('mods')->filterSettings(Ruleset::osu->value, 'WU', ['initial_rate' => '1']);

        $this->assertSame(1.0, $settings->initial_rate);
    }

    public function testModSettingsInvalid()
    {
        $this->expectException(InvariantException::class);
        app('mods')->filterSettings(Ruleset::osu->value, 'WU', ['x' => '1']);
    }

    public function testParseInputArray()
    {
        $input = [['acronym' => 'WU', 'settings' => []]];
        $parsed = app('mods')->parseInputArray(Ruleset::osu->value, $input);

        $this->assertSame(1, count($parsed));
        $this->assertSame(0, count((array) $parsed[0]->settings));
        $this->assertSame('WU', $parsed[0]->acronym);
    }

    public function testParseInputArrayInvalidMod()
    {
        $input = [['acronym' => 'XYZ', 'settings' => []]];

        $this->expectException(InvariantException::class);
        app('mods')->parseInputArray(Ruleset::osu->value, $input);
    }

    public function testParseInputArrayWithSettings()
    {
        $input = [['acronym' => 'WU', 'settings' => ['initial_rate' => '1', 'adjust_pitch' => false]]];
        $parsed = app('mods')->parseInputArray(Ruleset::osu->value, $input);

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
        app('mods')->parseInputArray(Ruleset::osu->value, $input);
    }

    public function testValidateSelectionWithInvalidRuleset()
    {
        $this->expectException(InvariantException::class);
        app('mods')->validateSelection(-1, []);
    }

    /**
     * @dataProvider multiplayerModComboExclusives
     */
    public function testAssertValidMultiplayerExclusivity(Ruleset $ruleset, $requiredIds, $allowedIds, $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvariantException::class);
        }

        $result = app('mods')->assertValidMultiplayerExclusivity($ruleset->value, $requiredIds, $allowedIds);

        if ($isValid) {
            $this->assertTrue($result);
        }
    }

    /**
     * @dataProvider modCombos
     */
    public function testValidateSelection(Ruleset $ruleset, $modCombo, $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvariantException::class);
        }

        $result = app('mods')->validateSelection($ruleset->value, $modCombo);

        if ($isValid) {
            $this->assertTrue($result);
        }
    }

    public static function modCombos()
    {
        return [
            // valid
            [Ruleset::osu, ['HD', 'DT'], true],
            [Ruleset::osu, ['HD', 'HR'], true],
            [Ruleset::osu, ['HD', 'HR'], true],
            [Ruleset::osu, ['HD', 'NC'], true],

            [Ruleset::taiko, ['HD', 'NC'], true],
            [Ruleset::taiko, ['HD', 'DT'], true],
            [Ruleset::taiko, ['HD', 'HR'], true],
            [Ruleset::taiko, ['HR', 'PF'], true],
            [Ruleset::taiko, ['RD', 'SD'], true],

            [Ruleset::catch, ['HD', 'HR'], true],
            [Ruleset::catch, ['HD', 'PF'], true],
            [Ruleset::catch, ['HD', 'SD'], true],
            [Ruleset::catch, ['HD'], true],
            [Ruleset::catch, ['EZ'], true],

            [Ruleset::mania, ['DT', 'PF'], true],
            [Ruleset::mania, ['NC', 'SD'], true],
            [Ruleset::mania, ['6K', 'HD'], true],
            [Ruleset::mania, ['4K', 'HT'], true],

            // invalid
            [Ruleset::osu, ['5K'], false],
            [Ruleset::osu, ['DS'], false],
            [Ruleset::osu, ['HD', 'HD'], false],

            [Ruleset::taiko, ['AP'], false],

            [Ruleset::catch, ['4K'], false],
            [Ruleset::catch, ['AP'], false],

            [Ruleset::mania, ['AP'], false],
        ];
    }

    public static function multiplayerModComboExclusives()
    {
        return [
            // non-exclusive required mods and no allowed mods
            [Ruleset::osu, ['HD', 'NC'], [], true],
            [Ruleset::mania, ['DT', 'PF'], [], true],

            // no conflicting exclusive required mods and allowed mods
            [Ruleset::osu, ['HD'], ['NC'], true],
            [Ruleset::mania, ['DT'], ['PF'], true],

            // conflicting exclusive required mods
            [Ruleset::osu, ['HT', 'DT'], [], false],
            [Ruleset::mania, ['FI', 'HD'], [], false],

            // allowed mods conflicts with exclusive required mods
            [Ruleset::osu, ['HT'], ['DT'], false],
            [Ruleset::taiko, ['HT'], ['DT'], false],
        ];
    }
}
