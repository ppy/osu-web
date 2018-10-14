<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
use App\Models\ChangelogEntry;

class ChangelogEntryTest extends TestCase
{
    public function testMessageHTMLVisibility()
    {
        $entry = new ChangelogEntry;

        $entry->message = 'Hidden';
        $this->assertSame(null, $entry->messageHTML());

        $entry->message = "---\nVisible";
        $this->assertSame("<p>Visible</p>\n", $entry->messageHTML());

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
        $this->assertSame("<p>Visible</p>\n", $entry->messageHTML());
    }
}
