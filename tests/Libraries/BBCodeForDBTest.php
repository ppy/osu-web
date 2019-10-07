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
