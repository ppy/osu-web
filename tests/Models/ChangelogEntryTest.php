<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\Changelog;
use App\Models\ChangelogEntry;
use Tests\TestCase;

class ChangelogEntryTest extends TestCase
{
    public function testMessageHTMLVisibility()
    {
        $entry = new ChangelogEntry();

        $entry->message = 'Hidden';
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "---\nVisible";
        $this->assertSame("<div class='changelog-md'><p class=\"changelog-md__paragraph\">Visible</p>\n</div>", $entry->messageHTML());

        $entry->message = "Hidden\n---";
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "Hidden\n\n---";
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "Hidden\n\n---Still hidden";
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "Hidden\n---\n\nStill hidden";
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "Hidden\n---\nStill hidden";
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "Hidden\n\n---\nVisible";
        $this->assertSame("<div class='changelog-md'><p class=\"changelog-md__paragraph\">Visible</p>\n</div>", $entry->messageHTML());
    }

    public function testConvertLegacyChangelogWithTitle()
    {
        $title = 'Some title';
        $legacy = new Changelog(['message' => $title]);
        $converted = ChangelogEntry::convertLegacy($legacy);
        $this->assertSame($title, $converted->title);
        $this->assertNull($converted->messageHTML());
    }

    public function testConvertLegacyChangelogWithTitleAndMessage()
    {
        $title = 'Some title';
        $message = 'Some message';
        $legacy = new Changelog(['message' => "{$title}\n\n---\n{$message}"]);
        $converted = ChangelogEntry::convertLegacy($legacy);
        $this->assertSame($title, $converted->title);
        $this->assertSame("<div class='changelog-md'><p class=\"changelog-md__paragraph\">{$message}</p>\n</div>", $converted->messageHTML());
    }

    public function testConvertLegacyChangelogWithMessage()
    {
        $message = 'Some message';
        $legacy = new Changelog(['message' => "---\n{$message}"]);
        $converted = ChangelogEntry::convertLegacy($legacy);
        $this->assertSame($message, $converted->title);
        $this->assertNull($converted->messageHTML());
    }

    public function testGuessCategoryCapitalise()
    {
        $data = [
            'repository' => ['full_name' => ''],
            'pull_request' => [
                'labels' => [
                    ['name' => 'forum'],
                ],
            ],
        ];

        $this->assertSame('Forum', ChangelogEntry::guessCategory($data));
    }

    public function testGuessCategoryDashToSpace()
    {
        $data = [
            'repository' => ['full_name' => ''],
            'pull_request' => [
                'labels' => [
                    ['name' => 'beatmapset-discussion'],
                ],
            ],
        ];

        $this->assertSame('Beatmapset Discussion', ChangelogEntry::guessCategory($data));
    }

    public function testGuessCategoryMixedDashAndSpaceNoConversion()
    {
        $data = [
            'repository' => ['full_name' => ''],
            'pull_request' => [
                'labels' => [
                    ['name' => 'beatmapset - discussion'],
                ],
            ],
        ];

        $this->assertSame('Beatmapset - Discussion', ChangelogEntry::guessCategory($data));
    }

    public function testGuessCategoryPrefixRemoval()
    {
        $data = [
            'repository' => ['full_name' => ''],
            'pull_request' => [
                'labels' => [
                    ['name' => 'area:forum'],
                ],
            ],
        ];

        $this->assertSame('Forum', ChangelogEntry::guessCategory($data));
    }

    public function testIsPrivate()
    {
        $data = [
            'repository' => ['full_name' => ''],
            'pull_request' => [
                'labels' => [
                    ['name' => 'javascript'],
                    ['name' => 'area:forum'],
                ],
            ],
        ];

        $this->assertFalse(ChangelogEntry::isPrivate($data));

        $data = [
            'repository' => ['full_name' => ''],
            'pull_request' => [
                'labels' => [
                    ['name' => 'javascript'],
                    ['name' => 'dependencies'],
                ],
            ],
        ];

        $this->assertTrue(ChangelogEntry::isPrivate($data));
    }
}
