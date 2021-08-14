<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

class LocaleTest extends TestCase
{
    public function testAll()
    {
        $fallbackLocale = 'en';
        osu_trans()->addLines([
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

        app()->setLocale($fallbackLocale);
        $this->assertSame('key_1.missing', osu_trans('key_1.missing'));
        $this->assertSame('test', osu_trans('key_1.simple'));
        $this->assertSame('test: stuff', osu_trans('key_1.keyed', ['value' => 'stuff']));
        $this->assertSame('1 unit', osu_trans_choice('key_1.choice', 1));
        $this->assertSame('2 units', osu_trans_choice('key_1.choice', 2));
        $this->assertSame('', osu_trans('key_1.empty'));

        $incompleteLocale = 'ja';
        osu_trans()->addLines([
            'key_1.simple' => 'テスト',
            'key_1.simple_empty' => '',
            'key_1.keyed' => 'テスト: :value',
            'key_1.keyed_empty' => '',
            'key_1.choice' => ':count個',
            'key_1.choice_empty' => '',
            'key_1.empty' => '',
        ], $incompleteLocale);

        app('translator')->setFallback($fallbackLocale);
        app()->setLocale($incompleteLocale);
        $this->assertSame('key_1.missing', osu_trans('key_1.missing'));
        $this->assertSame('テスト', osu_trans('key_1.simple'));
        $this->assertSame('test 2', osu_trans('key_1.simple_empty'));
        $this->assertSame('test 3', osu_trans('key_1.simple_missing'));

        $this->assertSame('テスト: stuff', osu_trans('key_1.keyed', ['value' => 'stuff']));
        $this->assertSame('test 2: stuff', osu_trans('key_1.keyed_empty', ['value' => 'stuff']));
        $this->assertSame('test 3: stuff', osu_trans('key_1.keyed_missing', ['value' => 'stuff']));

        $this->assertSame('1個', osu_trans_choice('key_1.choice', 1));
        $this->assertSame('2個', osu_trans_choice('key_1.choice', 2));
        $this->assertSame('1 item', osu_trans_choice('key_1.choice_empty', 1));
        $this->assertSame('2 items', osu_trans_choice('key_1.choice_empty', 2));
        $this->assertSame('1 entity', osu_trans_choice('key_1.choice_missing', 1));
        $this->assertSame('2 entities', osu_trans_choice('key_1.choice_missing', 2));
        $this->assertSame('', osu_trans('key_1.empty'));
        $this->assertSame('', osu_trans('key_1.empty_empty'));
        $this->assertSame('', osu_trans('key_1.empty_missing'));
    }

    /**
     * @dataProvider availableLocalesProvider
     */
    public function testCorrespondingLocaleFile($locale)
    {
        $this->assertNotNull(unmix("js/locales/{$locale}.js"));
    }

    /**
     * @dataProvider availableLocalesProvider
     */
    public function testCorrespondingMomentLocaleFile($locale)
    {
        $this->assertNotNull(unmix('js/moment-locales/'.locale_meta($locale)->moment().'.js'));
    }

    public function availableLocalesProvider()
    {
        return array_map(function ($locale) {
            return [$locale];
        }, config('app.available_locales'));
    }
}
