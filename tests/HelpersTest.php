<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

class HelpersTest extends TestCase
{
    /**
     * @dataProvider dataClassWithModifiers
     */
    public function testClassWithModifiers($class, $modifiers, $expected)
    {
        $this->assertSame($expected, class_with_modifiers($class, ...$modifiers));
    }

    public function dataClassWithModifiers()
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
}
