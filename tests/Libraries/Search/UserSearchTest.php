<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Search;

use App\Libraries\Search\UserSearch;
use App\Libraries\Search\UserSearchParams;
use App\Models\User;
use Tests\TestCase;

class UserSearchTest extends TestCase
{
    public function testQueryString()
    {
        $searchUser1 = User::factory()->create(['username' => 'hello']);
        $searchUser1->esIndexDocument();
        $searchUser2 = User::factory()->create(['username' => 'hello world']);
        $searchUser2->esIndexDocument();
        $user3 = User::factory()->create(['username' => 'aaaaaa']);
        $user3->esIndexDocument();
        (new UserSearch())->refresh();

        $params = new UserSearchParams();
        $params->queryString = $searchUser1->username;
        $search = new UserSearch($params);
        $userIds = array_map('intval', $search->response()->ids());
        sort($userIds);

        $this->assertSame(2, count($userIds));
        $this->assertSame($searchUser1->getKey(), $userIds[0]);
        $this->assertSame($searchUser2->getKey(), $userIds[1]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        (new UserSearch())->deleteAll();
    }
}
