<?php
/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
class ChatControllerTest extends TestCase
{
    //region POST /chat/new - Create New PM
    public function testCreatePMWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testCreatePMWhenBlocked() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testCreatePMWhenAlreadyExists() // fail?
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testCreatePM() // success
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    //endregion

    //region GET /chat/updates?since=[message_id] - Get Updates
    public function testChatUpdatesWhenGuest() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }

    public function testChatUpdates() // fail
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    //endregion
}
