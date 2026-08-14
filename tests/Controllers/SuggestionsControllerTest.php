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

    protected function setUp(): void
    {
        parent::setUp();

        $page1 = new Page('aaabbb', 'en');
        $page1->setSource([
            'locale' => 'en',
            'path' => 'aaabbb',
            'title' => 'aaabbb',
        ]);
        $page1->esIndexDocument();

        $page2 = new Page('aaaccc', 'id');
        $page2->setSource([
            'locale' => 'id',
            'path' => 'aaaccc',
            'title' => 'aaaccc',
        ]);
        $page2->esIndexDocument();

        (new WikiSuggestions(new WikiSuggestionsParams()))->refresh();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        (new WikiSuggestions(new WikiSuggestionsParams()))->deleteAll();
    }
}
