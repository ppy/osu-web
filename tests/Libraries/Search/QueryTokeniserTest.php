<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Search;

use App\Libraries\Elasticsearch\QueryHelper;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class QueryTokeniserTest extends TestCase
{
    public static function dataProvider()
    {
        return [
            ['', [], []],
            ['foo bar', ['foo', 'bar'], []],
            ['"foo bar"', ['"foo bar"'], []],
            ['llama "foo bar"', ['llama', '"foo bar"'], []],
            ['llama "foo bar" whee', ['llama', '"foo bar"', 'whee'], []],
            ['"foo bar" whee', ['"foo bar"', 'whee'], []],
            ['"foo" "bar" whee', ['"foo"', '"bar"', 'whee'], []],
            ['"foo" bar" whee', ['"foo"', 'bar"', 'whee'], []],
            ['"foo bar""', ['"foo bar""'], []],
            ['""foo bar""', ['""foo bar""'], []],
            ['"foo bar" "', ['"foo bar"', '"'], []],
            ['"foo bar -llamas', ['"foo bar -llamas'], []],

            ['" " " "" -"', ['" "', '" ""'], ['"']],

            ['-foo bar', ['bar'], ['foo']],
            ['foo -bar', ['foo'], ['bar']],
            ['-"foo bar"', [], ['"foo bar"']],
            ['llama -"foo bar"', ['llama'], ['"foo bar"']],
            ['more -"foo bar" llamas', ['more', 'llamas'], ['"foo bar"']],
            ['more -"foo bar" -bar llamas', ['more', 'llamas'], ['"foo bar"', 'bar']],
            ['-"foo -bar"', [], ['"foo -bar"']],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testParse(?string $query, array $include, array $exclude)
    {
        $tokens = QueryHelper::tokenise($query);
        $this->assertSame(json_encode($include), json_encode($tokens['include']));
        $this->assertSame(json_encode($exclude), json_encode($tokens['exclude']));
    }
}
