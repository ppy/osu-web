<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests;

use App\Models\Country;

class HelpersTest extends TestCase
{
    /**
     * @dataProvider dataForGetStringSplit
     */
    public function testGetStringSplit(string $input, array $expected): void
    {
        $this->assertSame($expected, get_string_split($input));
    }

    /**
     * @dataProvider dataForClassWithModifiers
     */
    public function testClassWithModifiers($class, $modifiers, $expected): void
    {
        $this->assertSame($expected, class_with_modifiers($class, ...$modifiers));
    }

    public function testIsSqlUniqueException(): void
    {
        $baseParams = [
            'rankedscore' => 0,
            'playcount' => 0,
            'usercount' => 0,
        ];

        (new Country([
            ...$baseParams,
            'acronym' => 'AA',
            'name' => '1',
        ]))->saveOrExplode();

        $exception = null;

        try {
            (new Country([
                ...$baseParams,
                'acronym' => 'AA',
                'name' => '2',
            ]))->saveOrExplode();
        } catch (\Exception $e) {
            $exception = $e;
        }

        $this->assertTrue(is_sql_unique_exception($exception));
    }

    /**
     * @dataProvider dataForGetLengthSeconds
     */
    public function testGetLengthSeconds(string $input, float $expected): void
    {
        $this->assertSame($expected, get_length_seconds($input));
    }

    public static function dataForGetLengthSeconds(): array
    {
        return [
            ['23s', 23],
            ['9m', 9 * 60],
            ['0.25h', 15 * 60],
            ['1h20s', (60 * 60) + 20],
            ['6h5m', (60 * 60 * 6) + (5 * 60)],
            ['6', 6],
            ['1:2:3', (60 * 60) + (2 * 60) + 3],
            ['1h2m3.5s', (60 * 60) + (2 * 60) + 3.5],
        ];
    }

    public static function dataForClassWithModifiers(): array
    {
        return [
            'no modifiers' =>
                ['cl', [], 'cl'],
            'string (one)' =>
                ['cl', ['hello'], 'cl cl--hello'],
            'string (two)' =>
                ['cl', ['hello', 'world'], 'cl cl--hello cl--world'],
            'array (empty)' =>
                ['cl', [[]], 'cl'],
            'array (one) with two strings' =>
                ['cl', [['hello', 'world']], 'cl cl--hello cl--world'],
            'array (one) with one string and two nulls' =>
                ['cl', [[null, 'hello', null]], 'cl cl--hello'],
            'array (two) with mixed strings and null' =>
                ['cl', [['hello', null, 'world'], ['foo', null]], 'cl cl--hello cl--world cl--foo'],
            'hash (one) with two true strings' =>
                ['cl', [['hello' => true, 'world' => true]], 'cl cl--hello cl--world'],
            'hash (one) with one true string and one false string' =>
                ['cl', [['hello' => true, 'world' => false]], 'cl cl--hello'],
            'hash (two) with mixed strings each' =>
                ['cl', [['hello' => true, 'world' => false], ['foo' => false, 'bar' => true]], 'cl cl--hello cl--bar'],
            'mixed' =>
                ['cl', ['hello', ['world' => true, 'foo' => false], ['bar', null]], 'cl cl--hello cl--world cl--bar'],
        ];
    }

    public static function dataForGetStringSplit(): array
    {
        return [
            ["hello\nworld\n!", ['hello', 'world', '!']],
            ["hello\rworld\n!", ['hello', 'world', '!']],
            ["hello\r\nworld\r!", ['hello', 'world', '!']],
            [" hello \r\n world \n ! ", ['hello', 'world', '!']],
            ['hello world', ['hello world']],
            ["\nhello world\n\n\r", ['hello world']],
        ];
    }
}
