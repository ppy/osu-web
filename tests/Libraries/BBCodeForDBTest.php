<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Libraries\BBCodeForDB;
use Tests\TestCase;

class BBCodeForDBTest extends TestCase
{
    private $uid = '1';

    /**
     * @dataProvider examples
     */
    public function testGenerate($name, $path)
    {
        config()->set('app.url', 'http://localhost');
        $baseFilePath = "{$path}/{$name}.base.txt";
        $dbFilePath = "{$path}/{$name}.db.txt";

        $text = new BBCodeForDB;
        $text->uid = $this->uid;
        $text->text = file_get_contents($baseFilePath);

        $output = $text->generate();

        $this->assertStringEqualsFile($dbFilePath, $output);
    }

    public function examples()
    {
        return $this->fileList(__DIR__.'/bbcode_examples', '.base.txt');
    }
}
