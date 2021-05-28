<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\BBCodeFromDB;
use Tests\TestCase;

class BBCodeFromDBTest extends TestCase
{
    /**
     * @dataProvider examples
     */
    public function testGenerateHTML($name, $path)
    {
        $dbFilePath = "{$path}/{$name}.db.txt";
        $htmlFilePath = "{$path}/{$name}.html";

        $text = new BBCodeFromDB('');
        $text->text = trim(file_get_contents($dbFilePath));

        $output = $this->normalizeHTML($text->toHTML());
        $referenceOutput = $this->normalizeHTML("<div class='bbcode'>".file_get_contents($htmlFilePath).'</div>');

        $this->assertSame($referenceOutput, $output);
    }

    /**
     * @dataProvider removeQuoteExamples
     */
    public function testRemoveBlockQuotes($name, $path)
    {
        $dbFilePath = "{$path}/{$name}.db.txt";
        $expectedFilePath = "{$path}/{$name}.expected.txt";

        $text = BBCodeFromDB::removeBlockQuotes(file_get_contents($dbFilePath));

        $this->assertStringEqualsFile($expectedFilePath, $text);
    }

    public function examples()
    {
        return $this->fileList(__DIR__.'/bbcode_examples', '.db.txt');
    }

    public function removeQuoteExamples()
    {
        return $this->fileList(__DIR__.'/bbcode_examples/remove_quotes', '.db.txt');
    }

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('osu.bbcode.uid', '1');
    }
}
