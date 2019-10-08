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

namespace Tests\Libraries\Markdown;

use App\Libraries\Markdown\OsuMarkdown;
use Tests\TestCase;

class IndexingProcessorTest extends TestCase
{
    /**
     * @dataProvider examples
     */
    public function testToIndexable($name, $path)
    {
        $mdFilePath = "{$path}/{$name}.md";
        $textFilePath = "{$path}/{$name}.txt";

        $markdown = file_get_contents($mdFilePath);

        $output = (new OsuMarkdown('wiki'))->load($markdown)->toIndexable();
        $referenceOutput = file_get_contents($textFilePath);

        $this->assertSame($referenceOutput, $output);
    }

    public function examples()
    {
        return $this->fileList(__DIR__.'/markdown_examples', '.md');
    }
}
