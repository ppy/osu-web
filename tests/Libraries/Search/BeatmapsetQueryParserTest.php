<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Search;

use App\Libraries\Search\BeatmapsetQueryParser;
use App\Models\Beatmapset;
use Tests\TestCase;

class BeatmapsetQueryParserTest extends TestCase
{
    /**
     * @dataProvider queryDataProvider
     */
    public function testParse(?string $query, ?array $expected)
    {
        $this->assertSame(json_encode($expected), json_encode(BeatmapsetQueryParser::parse($query)));
    }

    public function queryDataProvider()
    {
        return [
            // basic options
            ['stars=1', ['keywords' => null, 'options' => ['stars' => ['gte' => 0.995, 'lte' => 1.005]]]],
            ['star=1', ['keywords' => null, 'options' => ['stars' => ['gte' => 0.995, 'lte' => 1.005]]]],
            ['ar=2', ['keywords' => null, 'options' => ['ar' => ['gte' => 1.95, 'lte' => 2.05]]]],
            ['dr=3', ['keywords' => null, 'options' => ['dr' => ['gte' => 2.95, 'lte' => 3.05]]]],
            ['hp<4', ['keywords' => null, 'options' => ['dr' => ['lte' => 3.95]]]],
            ['cs>5', ['keywords' => null, 'options' => ['cs' => ['gte' => 5.05]]]],
            ['bpm<=6', ['keywords' => null, 'options' => ['bpm' => ['lte' => 6.005]]]],
            ['length<70000ms', ['keywords' => null, 'options' => ['length' => ['lte' => 69.9995]]]],
            ['length>=70', ['keywords' => null, 'options' => ['length' => ['gte' => 69.5]]]],
            ['length>=70s', ['keywords' => null, 'options' => ['length' => ['gte' => 69.5]]]],
            ['length:8m', ['keywords' => null, 'options' => ['length' => ['gte' => 450, 'lte' => 510]]]],
            ['length:0.9h', ['keywords' => null, 'options' => ['length' => ['gte' => (0.9 * 3600 - 1800), 'lte' => (0.9 * 3600 + 1800)]]]],
            ['keys=10', ['keywords' => null, 'options' => ['keys' => ['gte' => 10, 'lte' => 10]]]],
            ['divisor>0', ['keywords' => null, 'options' => ['divisor' => ['gt' => 0]]]],
            ['status<ranked', ['keywords' => null, 'options' => ['status' => ['lt' => Beatmapset::STATES['ranked']]]]],
            ['status=graveyard', ['keywords' => null, 'options' => ['status' => ['gte' => Beatmapset::STATES['graveyard'], 'lte' => Beatmapset::STATES['graveyard']]]]],
            ['creator=hello', ['keywords' => null, 'options' => ['creator' => 'hello']]],
            ['artist=hello', ['keywords' => null, 'options' => ['artist' => 'hello']]],
            ['artist="hello world"', ['keywords' => null, 'options' => ['artist' => 'hello world']]],
            ['created=2017', ['keywords' => null, 'options' => ['created' => ['gte' => '2017-01-01T00:00:00+00:00', 'lt' => '2018-01-01T00:00:00+00:00']]]],
            ['ranked>2018', ['keywords' => null, 'options' => ['ranked' => ['gte' => '2019-01-01T00:00:00+00:00']]]],
            ['ranked<2018-05', ['keywords' => null, 'options' => ['ranked' => ['lt' => '2018-05-01T00:00:00+00:00']]]],
            ['ranked<=2018.05', ['keywords' => null, 'options' => ['ranked' => ['lt' => '2018-06-01T00:00:00+00:00']]]],
            ['ranked=2018/05', ['keywords' => null, 'options' => ['ranked' => ['gte' => '2018-05-01T00:00:00+00:00', 'lt' => '2018-06-01T00:00:00+00:00']]]],
            ['ranked=2018.05.01', ['keywords' => null, 'options' => ['ranked' => ['gte' => '2018-05-01T00:00:00+00:00', 'lt' => '2018-05-02T00:00:00+00:00']]]],
            ['ranked>2018/05/01', ['keywords' => null, 'options' => ['ranked' => ['gte' => '2018-05-02T00:00:00+00:00']]]],
            ['ranked>="2020-07-21 12:30:30 +09:00"', ['keywords' => null, 'options' => ['ranked' => ['gte' => '2020-07-21T12:30:30+09:00']]]],
            ['ranked="2020-07-21 12:30:30 +09:00"', ['keywords' => null, 'options' => ['ranked' => ['gte' => '2020-07-21T12:30:30+09:00', 'lt' => '2020-07-21T12:30:31+09:00']]]],
            ['ranked="invalid date format"', ['keywords' => 'ranked="invalid date format"', 'options' => []]],

            // multiple options
            ['artist=hello creator:world', ['keywords' => null, 'options' => ['artist' => 'hello', 'creator' => 'world']]],

            // last option overrides previous ones
            ['dr=1 dr=9', ['keywords' => null, 'options' => ['dr' => ['gte' => 8.95, 'lte' => 9.05]]]],
            ['artist=hello artist:world', ['keywords' => null, 'options' => ['artist' => 'world']]],

            // last option overrides previous ones, including with different names
            ['dr=1 hp<9', ['keywords' => null, 'options' => ['dr' => ['gte' => 0.95, 'lte' => 8.95]]]],

            // keyword with options
            ['hello stars>=1 stars<4', ['keywords' => 'hello', 'options' => ['stars' => ['gte' => 0.995, 'lte' => 3.995]]]],

            // keywords with option in between
            ['hello ar<:1 world', ['keywords' => 'hello  world', 'options' => ['ar' => ['lte' => 1.05]]]],

            // option with invalid operator is ignored (and becomes keyword)
            ['artist>a', ['keywords' => 'artist>a', 'options' => []]],
            ['dr=a', ['keywords' => 'dr=a', 'options' => []]],

            // taken from https://github.com/ppy/osu/blob/b3e96c8385fdfec3ea1bb3899f74763ccafa055c/osu.Game.Tests/NonVisual/Filtering/FilterQueryParserTest.cs
            ['stars<4 easy', ['keywords' => 'easy', 'options' => ['stars' => ['lte' => 3.995]]]],
            ['ar>=9 difficult', ['keywords' => 'difficult', 'options' => ['ar' => ['gte' => 8.95]]]],
            ['dr>2 quite specific dr<:6', ['keywords' => 'quite specific', 'options' => ['dr' => ['gte' => 2.05, 'lte' => 6.05]]]],
            ['hp>2 quite specific hp<=6', ['keywords' => 'quite specific', 'options' => ['dr' => ['gte' => 2.05, 'lte' => 6.05]]]],
            ['bpm>:200 gotta go fast', ['keywords' => 'gotta go fast', 'options' => ['bpm' => ['gte' => 199.995]]]],
            ['length=6ms time', ['keywords' => 'time', 'options' => ['length' => ['gte' => (6 / 1000 - 1 / 2000), 'lte' => (6 / 1000 + 1 / 2000)]]]],
            ['length=23s time', ['keywords' => 'time', 'options' => ['length' => ['gte' => 22.5, 'lte' => 23.5]]]],
            ['length=9m time', ['keywords' => 'time', 'options' => ['length' => ['gte' => (9 * 60 - 30), 'lte' => (9 * 60 + 30)]]]],
            ['length=0.25h time', ['keywords' => 'time', 'options' => ['length' => ['gte' => (0.25 * 3600 - 1800), 'lte' => (0.25 * 3600 + 1800)]]]],
            ['length=70 time', ['keywords' => 'time', 'options' => ['length' => ['gte' => 69.5, 'lte' => 70.5]]]],
            ["that's a time signature alright! divisor:12", ['keywords' => "that's a time signature alright!", 'options' => ['divisor' => ['gte' => 12, 'lte' => 12]]]],
            ['I want the pp status=ranked', ['keywords' => 'I want the pp', 'options' => ['status' => ['gte' => Beatmapset::STATES['ranked'], 'lte' => Beatmapset::STATES['ranked']]]]],
            ['beatmap specifically by creator=my_fav', ['keywords' => 'beatmap specifically by', 'options' => ['creator' => 'my_fav']]],
            ['find me songs by artist=singer please', ['keywords' => 'find me songs by  please', 'options' => ['artist' => 'singer']]],
            ['really like artist="name with space" yes', ['keywords' => 'really like  yes', 'options' => ['artist' => 'name with space']]],
            ['weird artist=double"quote', ['keywords' => 'weird', 'options' => ['artist' => 'double"quote']]],
            ['artist=><something', ['keywords' => null, 'options' => ['artist' => '><something']]],
            ['unrecognised=keyword', ['keywords' => 'unrecognised=keyword', 'options' => []]],
            ['cs=nope', ['keywords' => 'cs=nope', 'options' => []]],
            ['bpm=bad', ['keywords' => 'bpm=bad', 'options' => []]],
            ['divisor<nah', ['keywords' => 'divisor<nah', 'options' => []]],
            ['status=noidea', ['keywords' => 'status=noidea', 'options' => []]],
        ];
    }
}
