<?php

namespace Test\Libraries\AcceptHttpLanguage;

use App\Libraries\AcceptHttpLanguage\Parser;
use TestCase;

class ParserTest extends TestCase
{
    /** @var Parser */
    private $parser;

    public function setUp()
    {
        $this->parser = new Parser('en-us,en-gb;q=0.8,en;q=0.6,es-419');
    }

    public function testShouldReturnEmptyArray() {
        $this->parser->header = null;
        $this->assertSame([], $this->parser->userPreferredLanguages());
    }

    public function testShouldProperlySplit() {
        $this->assertSame(['en-US', 'es-419', 'en-GB', 'en'], $this->parser->userPreferredLanguages());
    }

    public function testShouldIgnoreJambledHeader() {
        $this->parser->header = 'odkhjf89fioma098jq .,.,';
        $this->assertSame([], $this->parser->userPreferredLanguages());
    }

    public function testShouldProperlyRespectWhitespace() {
        $this->parser->header = 'en-us, en-gb; q=0.8,en;q = 0.6,es-419';
        $this->assertSame(['en-US', 'es-419', 'en-GB', 'en'], $this->parser->userPreferredLanguages());
    }

    public function testShouldFindFirstAvailableLanguage() {
        $this->assertSame('en-GB', $this->parser->preferredLanguageFrom(['en', 'en-GB']));
    }

    public function testShouldFindFirstCompatibleLanguage() {
        $this->assertSame('en-hk', $this->parser->compatibleLanguageFrom(['en-hk']));
        $this->assertSame('en', $this->parser->compatibleLanguageFrom(['en']));
    }

    public function testShouldfindFirstCompatibleFromUserPreferred() {
        $this->parser->header = 'en-us,de-de';
        $this->assertSame('en', $this->parser->compatibleLanguageFrom(['de', 'en']));
    }

    public function testShouldAcceptAndIgnoreWildcards() {
        $this->parser->header = 'en-US,en,*';
        $this->assertSame('en-US', $this->parser->compatibleLanguageFrom(['en-US']));
    }

    public function testShouldSanitizeAvailableLanguageNames() {
        $this->assertSame(
            ['en-UK', 'en-US', 'ja-JP', 'pt-BR', 'es-419'],
            $this->parser->sanitizeAvailableLocales(['en_UK-x3', 'en-US-x1', 'ja_JP-x2', 'pt-BR-x5', 'es-419-x4'])
        );
    }

    public function testShouldFindMostCompatibleLanguageFromUserPreferred() {
        $this->parser->header = 'ja,en-gb,en-us,fr-fr';
        $this->assertSame('ja-JP', $this->parser->languageRegionCompatibleFrom(['en-UK', 'en-US', 'ja-JP']));
    }
}
