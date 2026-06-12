<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Search;

use App\Libraries\Search\BeatmapsetQueryParser;
use App\Models\Beatmapset;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BeatmapsetQueryParserTest extends TestCase
{
    public static function queryDataProvider()
    {
        return [
            // basic options
            ['stars=1', null, ['difficultyRating' => ['gte' => 0.995, 'lte' => 1.005]]],
            ['star=1', null, ['difficultyRating' => ['gte' => 0.995, 'lte' => 1.005]]],
            ['ar=2', null, ['ar' => ['gte' => 1.95, 'lte' => 2.05]]],
            ['dr=3', null, ['drain' => ['gte' => 2.95, 'lte' => 3.05]]],
            ['hp<4', null, ['drain' => ['lte' => 3.95]]],
            ['cs>5', null, ['cs' => ['gte' => 5.05]]],
            ['od>=9', null, ['accuracy' => ['gte' => 8.95]]],
            ['bpm<=6', null, ['bpm' => ['lte' => 6.005]]],
            ['length<70000ms', null, ['totalLength' => ['lte' => 69.9995]]],
            ['length>=70', null, ['totalLength' => ['gte' => 69.5]]],
            ['length>=70s', null, ['totalLength' => ['gte' => 69.5]]],
            ['length:8m', null, ['totalLength' => ['gte' => 450, 'lte' => 510]]],
            ['length:0.9h', null, ['totalLength' => ['gte' => (0.9 * 3600 - 1800), 'lte' => (0.9 * 3600 + 1800)]]],
            ['keys=10', null, ['keys' => ['gte' => 10, 'lte' => 10]]],
            ['divisor>0', null, ['divisor' => ['gt' => 0]]],
            ['status<ranked', null, ['statusRange' => ['lt' => Beatmapset::STATES['ranked']]]],
            ['status=graveyard', null, ['statusRange' => ['gte' => Beatmapset::STATES['graveyard'], 'lte' => Beatmapset::STATES['graveyard']]]],
            ['creator=hello', null, ['creator' => 'hello']],
            ['artist=hello', null, ['artist' => 'hello']],
            ['artist="hello world"', null, ['artist' => 'hello world']],
            ['created=2017', null, ['created' => ['gte' => static::parseTime('2017-01-01'), 'lt' => static::parseTime('2018-01-01')]]],
            ['submitted=2017', null, ['created' => ['gte' => static::parseTime('2017-01-01'), 'lt' => static::parseTime('2018-01-01')]]],
            ['ranked>2018', null, ['ranked' => ['gte' => static::parseTime('2019-01-01')]]],
            ['ranked<2018-05', null, ['ranked' => ['lt' => static::parseTime('2018-05-01')]]],
            ['ranked<=2018.05', null, ['ranked' => ['lt' => static::parseTime('2018-06-01')]]],
            ['ranked=2018/05', null, ['ranked' => ['gte' => static::parseTime('2018-05-01'), 'lt' => static::parseTime('2018-06-01')]]],
            ['ranked=2018.05.01', null, ['ranked' => ['gte' => static::parseTime('2018-05-01'), 'lt' => static::parseTime('2018-05-02')]]],
            ['ranked>2018/05/01', null, ['ranked' => ['gte' => static::parseTime('2018-05-02')]]],
            ['ranked>="2020-07-21 12:30:30 +09:00"', null, ['ranked' => ['gte' => static::parseTime('2020-07-21 03:30:30')]]],
            ['ranked="2020-07-21 12:30:30 +09:00"', null, ['ranked' => ['gte' => static::parseTime('2020-07-21 03:30:30'), 'lt' => static::parseTime('2020-07-21 03:30:31')]]],
            ['ranked>="2020-07-21 12:30:30 +09:00" ranked<="2020-08-21 13:40:40 +09:00"', null, ['ranked' => ['gte' => static::parseTime('2020-07-21 03:30:30'), 'lt' => static::parseTime('2020-08-21 04:40:41')]]],
            ['ranked="invalid date format"', 'ranked="invalid date format"', []],
            ['tag=hello', null, ['tags' => ['hello']]],
            ['tag=hello tag=world', null, ['tags' => ['hello', 'world']]],
            ['tag=hello -tag=world', null, ['tags' => ['hello']], ['tags' => ['world']]],
            ['tag="hello world"', null, ['tags' => ['hello world']]],
            ['tag="hello world" tag="foo bar"', null, ['tags' => ['hello world', 'foo bar']]],
            ['tag="hello world"aa tag="foo bar"', 'aa', ['tags' => ['hello world', 'foo bar']]],

            // float with , and . parse the same
            ['star=1,5', null, ['difficultyRating' => ['gte' => 1.495, 'lte' => 1.505]]],
            ['star=1.5', null, ['difficultyRating' => ['gte' => 1.495, 'lte' => 1.505]]],

            // multiple options
            ['artist=hello creator:world', null, ['artist' => 'hello', 'creator' => 'world']],

            // last option overrides previous ones
            ['dr=1 dr=9', null, ['drain' => ['gte' => 8.95, 'lte' => 9.05]]],
            ['artist=hello artist:world', null, ['artist' => 'world']],

            // last option overrides previous ones, including with different names
            ['dr=1 hp<9', null, ['drain' => ['gte' => 0.95, 'lte' => 8.95]]],

            // keyword with options
            ['hello stars>=1 stars<4', 'hello', ['difficultyRating' => ['gte' => 0.995, 'lte' => 3.995]]],

            // keywords with option in between
            ['hello ar<:1 world', 'hello  world', ['ar' => ['lte' => 1.05]]],

            // option with invalid operator is ignored (and becomes keyword)
            ['artist>a', 'artist>a', []],
            ['dr=a', 'dr=a', []],

            // taken from https://github.com/ppy/osu/blob/b3e96c8385fdfec3ea1bb3899f74763ccafa055c/osu.Game.Tests/NonVisual/Filtering/FilterQueryParserTest.cs
            ['stars<4 easy', 'easy', ['difficultyRating' => ['lte' => 3.995]]],
            ['ar>=9 difficult', 'difficult', ['ar' => ['gte' => 8.95]]],
            ['dr>2 quite specific dr<:6', 'quite specific', ['drain' => ['gte' => 2.05, 'lte' => 6.05]]],
            ['hp>2 quite specific hp<=6', 'quite specific', ['drain' => ['gte' => 2.05, 'lte' => 6.05]]],
            ['od>4 easy od<8', 'easy', ['accuracy' => ['gte' => 4.05, 'lte' => 7.95]]],
            ['bpm>:200 gotta go fast', 'gotta go fast', ['bpm' => ['gte' => 199.995]]],
            ['length=6ms time', 'time', ['totalLength' => ['gte' => (6 / 1000 - 1 / 2000), 'lte' => (6 / 1000 + 1 / 2000)]]],
            ['length=23s time', 'time', ['totalLength' => ['gte' => 22.5, 'lte' => 23.5]]],
            ['length=9m time', 'time', ['totalLength' => ['gte' => (9 * 60 - 30), 'lte' => (9 * 60 + 30)]]],
            ['length=0.25h time', 'time', ['totalLength' => ['gte' => (0.25 * 3600 - 1800), 'lte' => (0.25 * 3600 + 1800)]]],
            ['length=70 time', 'time', ['totalLength' => ['gte' => 69.5, 'lte' => 70.5]]],
            ["that's a time signature alright! divisor:12", "that's a time signature alright!", ['divisor' => ['gte' => 12, 'lte' => 12]]],
            ['I want the pp status=ranked', 'I want the pp', ['statusRange' => ['gte' => Beatmapset::STATES['ranked'], 'lte' => Beatmapset::STATES['ranked']]]],
            ['beatmap specifically by creator=my_fav', 'beatmap specifically by', ['creator' => 'my_fav']],
            ['find me songs by artist=singer please', 'find me songs by  please', ['artist' => 'singer']],
            ['really like artist="name with space" yes', 'really like  yes', ['artist' => 'name with space']],
            ['weird artist=double"quote', 'weird', ['artist' => 'double"quote']],
            ['weird artist="nested \"quote\"" thing', 'weird  thing', ['artist' => 'nested "quote"']],
            ['artist=><something', null, ['artist' => '><something']],
            ['unrecognised=keyword', 'unrecognised=keyword', []],
            ['cs=nope', 'cs=nope', []],
            ['bpm=bad', 'bpm=bad', []],
            ['divisor<nah', 'divisor<nah', []],
            ['status=noidea', 'status=noidea', []],
            ['status=l', null, ['statusRange' => ['gte' => Beatmapset::STATES['loved'], 'lte' => Beatmapset::STATES['loved']]]],
            ['status=lo', null, ['statusRange' => ['gte' => Beatmapset::STATES['loved'], 'lte' => Beatmapset::STATES['loved']]]],
        ];
    }

    private static function parseTime(string $timeString): int
    {
        return CarbonImmutable::parse($timeString)->getTimestampMs();
    }

    #[DataProvider('queryDataProvider')]
    public function testParse(?string $query, ?string $keywords, array $includes, ?array $excludes = [])
    {
        $parser = new BeatmapsetQueryParser($query);
        $this->assertSame(json_encode($keywords), json_encode($parser->keywords));
        $this->assertSame(json_encode($includes), json_encode($parser->includes->toArray()));
        $this->assertSame(json_encode($excludes), json_encode($parser->excludes->toArray()));
    }
}
