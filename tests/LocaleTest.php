<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests;

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

        app()->setLocale($fallbackLocale);
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
        app()->setLocale($incompleteLocale);
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
