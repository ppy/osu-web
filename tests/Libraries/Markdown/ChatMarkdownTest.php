<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Markdown;

use Tests\TestCase;

class ChatMarkdownTest extends TestCase
{
    /**
     * @dataProvider chatExamples
     */
    public function testChat($name, $path)
    {
        [$markdown, $expectedOutput] = $this->loadOutputTest($name, $path);

        $this->assertSame(
            $this->normalizeHTML($expectedOutput),
            $this->normalizeHTML(markdown_chat($markdown)),
        );
    }

    public function chatExamples()
    {
        return $this->fileList(__DIR__.'/chat_markdown_examples', '.md');
    }

    private function loadOutputTest(string $name, string $path)
    {
        $mdFilePath = "{$path}/{$name}.md";
        $htmlFilePath = "{$path}/{$name}.html";

        return [
            file_get_contents($mdFilePath),
            file_get_contents($htmlFilePath),
        ];
    }
}
