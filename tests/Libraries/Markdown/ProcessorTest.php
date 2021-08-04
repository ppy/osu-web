<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Markdown;

use App\Libraries\Markdown\OsuMarkdown;
use Tests\TestCase;

class ProcessorTest extends TestCase
{
    /**
     * @dataProvider htmlExamples
     */
    public function testHtml($name, $path)
    {
        [$osuMarkdown, $expectedOutput] = $this->loadOutputTest($name, $path, 'html');

        $this->assertSame(
            $this->normalizeHTML("<div class='osu-md'>{$expectedOutput}</div>"),
            $this->normalizeHTML($osuMarkdown->html()),
        );
    }

    /**
     * @dataProvider indexableExamples
     */
    public function testIndexable($name, $path)
    {
        [$osuMarkdown, $expectedOutput] = $this->loadOutputTest($name, $path, 'txt');

        $this->assertSame($expectedOutput, $osuMarkdown->toIndexable());
    }

    public function htmlExamples()
    {
        return $this->fileList(__DIR__.'/html_markdown_examples', '.md');
    }

    public function indexableExamples()
    {
        return $this->fileList(__DIR__.'/indexable_markdown_examples', '.md');
    }

    private function loadOutputTest(string $name, string $path, string $extension)
    {
        $mdFilePath = "{$path}/{$name}.md";
        $textFilePath = "{$path}/{$name}.{$extension}";

        return [
            (new OsuMarkdown('default', [
                'parse_attribute_id' => true,
                'parse_footnote' => true,
                'style_block_allowed_classes' => ['class-name'],
            ]))->load(file_get_contents($mdFilePath)),
            file_get_contents($textFilePath),
        ];
    }
}
