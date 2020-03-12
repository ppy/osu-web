<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
