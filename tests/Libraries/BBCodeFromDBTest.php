<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tests\Libraries;

use App\Libraries\BBCodeFromDB;
use Tests\TestCase;

class BBCodeFromDBTest extends TestCase
{
    private $uid = '1';

    /**
     * @dataProvider examples
     */
    public function testGenerateHTML($name, $path)
    {
        $dbFilePath = "{$path}/{$name}.db.txt";
        $htmlFilePath = "{$path}/{$name}.html";

        $text = new BBCodeFromDB('', $this->uid);
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
}
