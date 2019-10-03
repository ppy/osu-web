<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

use App;

class LocaleTest extends TestCase
{
    public function testAll()
    {
        $fallbackLocale = 'en';
        trans()->addLines([
            'key_1.simple' => 'test',
            'key_1.simple_empty' => 'test 2',
            'key_1.simple_missing' => 'test 3',
            'key_1.keyed' => 'test: :value',
            'key_1.keyed_empty' => 'test 2: :value',
            'key_1.keyed_missing' => 'test 3: :value',
            'key_1.choice' => ':count unit|:count units',
            'key_1.choice_empty' => ':count item|:count items',
            'key_1.choice_missing' => ':count entity|:count entities',
            'key_1.empty' => '',
            'key_1.empty_empty' => '',
            'key_1.empty_missing' => '',
        ], $fallbackLocale);

        App::setLocale($fallbackLocale);
        $this->assertSame('key_1.missing', trans('key_1.missing'));
        $this->assertSame('test', trans('key_1.simple'));
        $this->assertSame('test: stuff', trans('key_1.keyed', ['value' => 'stuff']));
        $this->assertSame('1 unit', trans_choice('key_1.choice', 1));
        $this->assertSame('2 units', trans_choice('key_1.choice', 2));
        $this->assertSame('', trans('key_1.empty'));

        $incompleteLocale = 'ja';
        trans()->addLines([
            'key_1.simple' => 'テスト',
            'key_1.simple_empty' => '',
            'key_1.keyed' => 'テスト: :value',
            'key_1.keyed_empty' => '',
            'key_1.choice' => ':count個',
            'key_1.choice_empty' => '',
            'key_1.empty' => '',
        ], $incompleteLocale);

        app('translator')->setFallback($fallbackLocale);
        App::setLocale($incompleteLocale);
        $this->assertSame('key_1.missing', trans('key_1.missing'));
        $this->assertSame('テスト', trans('key_1.simple'));
        $this->assertSame('test 2', trans('key_1.simple_empty'));
        $this->assertSame('test 3', trans('key_1.simple_missing'));

        $this->assertSame('テスト: stuff', trans('key_1.keyed', ['value' => 'stuff']));
        $this->assertSame('test 2: stuff', trans('key_1.keyed_empty', ['value' => 'stuff']));
        $this->assertSame('test 3: stuff', trans('key_1.keyed_missing', ['value' => 'stuff']));

        $this->assertSame('1個', trans_choice('key_1.choice', 1));
        $this->assertSame('2個', trans_choice('key_1.choice', 2));
        $this->assertSame('1 item', trans_choice('key_1.choice_empty', 1));
        $this->assertSame('2 items', trans_choice('key_1.choice_empty', 2));
        $this->assertSame('1 entity', trans_choice('key_1.choice_missing', 1));
        $this->assertSame('2 entities', trans_choice('key_1.choice_missing', 2));
        $this->assertSame('', trans('key_1.empty'));
        $this->assertSame('', trans('key_1.empty_empty'));
        $this->assertSame('', trans('key_1.empty_missing'));
    }
}
