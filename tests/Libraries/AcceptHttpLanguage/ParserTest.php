<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

/**
 * This is a port of parser_spec from the http_accept_language gem
 * https://github.com/iain/http_accept_language/blob/v2.1.1/spec/parser_spec.rb.
 */

namespace Tests\Libraries\AcceptHttpLanguage;

use App\Libraries\AcceptHttpLanguage\Parser;
use Tests\TestCase;

class ParserTest extends TestCase
{
    private const DEFAULT_HEADER = 'en-us,en-gb;q=0.8,en;q=0.6,es-419';

    public function testShouldReturnEmptyArray()
    {
        $this->assertSame([], Parser::parseHeader(null));
    }

    public function testShouldProperlySplit()
    {
        $this->assertSame(
            ['en-us', 'es-419', 'en-gb', 'en'],
            Parser::parseHeader('en-us,en-gb;q=0.8,en;q=0.6,es-419'),
        );
    }

    public function testShouldIgnoreJambledHeader()
    {
        $this->assertSame([], Parser::parseHeader('odkhjf89fioma098jq .,.,'));
    }

    public function testShouldProperlyRespectWhitespace()
    {
        $this->assertSame(
            ['en-us', 'es-419', 'en-gb', 'en'],
            Parser::parseHeader('en-us, en-gb; q=0.8,en;q = 0.6,es-419'),
        );
    }

    public function testShouldFindFirstCompatibleLanguage()
    {
        $this->assertSame(
            'en-hk',
            (new Parser(['en-hk']))->languageRegionCompatibleFor(static::DEFAULT_HEADER),
        );

        $this->assertSame(
            'en',
            (new Parser(['en']))->languageRegionCompatibleFor(static::DEFAULT_HEADER),
        );
    }

    public function testShouldfindFirstCompatibleFromUserPreferred()
    {
        $this->assertSame(
            'en',
            (new Parser(['de', 'en']))->languageRegionCompatibleFor('en-us,de-de'),
        );
    }

    public function testShouldAcceptAndIgnoreWildcards()
    {
        $this->assertSame(
            'en-us',
            (new Parser(['en-us']))->languageRegionCompatibleFor('en-US,en,*'),
        );
    }

    public function testShouldFindMostCompatibleLanguageFromUserPreferred()
    {
        $this->assertSame(
            'ja-jp',
            (new Parser(['en-uk', 'en-us', 'ja-jp']))->languageRegionCompatibleFor('ja,en-gb,en-us,fr-fr'),
        );
    }
}
