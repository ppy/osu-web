<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, version 3 of the License.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
use App\Libraries\BBCodeForDB;

class BBCodeForDBTest extends TestCase
{
    private $uid = '1';

    public function testAll()
    {
        $text = new BBCodeForDB();
        $text->uid = $this->uid;
        $path = __DIR__.'/bbcode_examples';

        foreach (glob("{$path}/*.base.txt") as $baseFilePath) {
            $dbFilePath = preg_replace("/\.base\.txt$/", '.db.txt', $baseFilePath);
            $text->text = trim(file_get_contents($baseFilePath));
            $referenceDbOutput = trim(file_get_contents($dbFilePath));

            $this->assertEquals($referenceDbOutput, $text->generate());
        }
    }
}
