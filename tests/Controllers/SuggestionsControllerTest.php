<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Libraries\Search\WikiSuggestions;
use App\Libraries\Search\WikiSuggestionsParams;
use App\Models\Wiki\Page;
use Tests\TestCase;

class SuggestionsControllerTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        $docs = [
            ['locale' => 'en', 'path' => 'aaabbb', 'title' => 'aaabbb'],
            ['locale' => 'en', 'path' => 'aaaccc', 'title' => 'aaaccc'],
            ['locale' => 'id', 'path' => 'aaaccc', 'title' => 'aaaccc'],
        ];

        foreach ($docs as $doc) {
            $page = new Page($doc['path'], $doc['locale']);
            $page->setSource($doc);
            $page->esIndexDocument();
        }

        new WikiSuggestions(new WikiSuggestionsParams())->refresh();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        new WikiSuggestions(new WikiSuggestionsParams())->deleteAll();
    }

    public function testSuggestionWikiWithoutLocale()
    {
        $this
            ->get(route('suggestions.wiki', ['query' => 'aaa']))
            ->assertSuccessful()
            ->assertJson([
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
            ]);
    }

    public function testSuggestionWikiWithLocale()
    {
        $this
            ->get(route('suggestions.wiki', ['locale' => 'id', 'query' => 'aaa']))
            ->assertSuccessful()
            ->assertJson([
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
            ]);
    }
}
