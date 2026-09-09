<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Search;

use App\Libraries\Search\WikiSuggestions;
use App\Libraries\Search\WikiSuggestionsParams;
use App\Models\Wiki\Page;
use App\Transformers\WikiSuggestionsHitTransformer;
use PHPUnit\Framework\Attributes\AfterClass;
use PHPUnit\Framework\Attributes\BeforeClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class WikiSuggestionsTest extends TestCase
{
    #[AfterClass]
    public static function cleanEs(): void
    {
        new WikiSuggestions(new WikiSuggestionsParams())->deleteAll();
    }

    public static function dataProviderForSuggestions(): array
    {
        return [
            [null, [
                [
                    'highlight' => '<em>aaa</em>bbb',
                    'locale' => 'en',
                    'path' => 'aaabbb',
                    'title' => 'aaabbb',
                ],
                [
                    'highlight' => '<em>aaa</em>ccc',
                    'locale' => 'en',
                    'path' => 'aaaccc',
                    'title' => 'aaaccc',
                ],
            ]],
            ['id', [
                [
                    'highlight' => '<em>aaa</em>ccc',
                    'locale' => 'id',
                    'path' => 'aaaccc',
                    'title' => 'aaaccc',
                ],
                [
                    'highlight' => '<em>aaa</em>bbb',
                    'locale' => 'en',
                    'path' => 'aaabbb',
                    'title' => 'aaabbb',
                ],
            ]],
        ];
    }

    #[BeforeClass]
    public static function setupEs(): void
    {
        $docs = [
            ['locale' => 'en', 'path' => 'aaabbb', 'title' => 'aaabbb'],
            ['locale' => 'en', 'path' => 'aaaccc', 'title' => 'aaaccc'],
            ['locale' => 'id', 'path' => 'aaaccc', 'title' => 'aaaccc'],
        ];

        foreach ($docs as $doc) {
            $page = new Page($doc['path'], $doc['locale']);
            $page->logger = static fn () => null; // just skip the logger instead of setting up the application
            $page->setSource($doc);
            $page->esIndexDocument();
        }

        new WikiSuggestions(new WikiSuggestionsParams())->refresh();
    }

    #[DataProvider('dataProviderForSuggestions')]
    public function testSuggestions(?string $locale, array $expected)
    {
        $params = new WikiSuggestionsParams();
        $params->queryString = 'aaa';
        $params->locale = $locale;
        $response = new WikiSuggestions($params)->response();

        $json = json_collection([...$response], new WikiSuggestionsHitTransformer());
        $this->assertSame($expected, $json);
    }
}
