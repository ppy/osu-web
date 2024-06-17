<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Session;

use App\Libraries\Session\Store;
use App\Models\User;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function testBatchDeleteRemovesCurrentSessionUserId(): void
    {
        $user = User::factory()->create();
        \Auth::login($user);
        $session = \Session::instance();

        $this->assertSame($user->getKey(), $session->userId());

        Store::batchDelete($user->getKey(), [$session->getId()]);

        $this->assertNull($session->userId());
    }

    public function testUserId(): void
    {
        $this->assertNull(\Session::userId());

        $user = User::factory()->create();
        \Auth::login($user);

        $this->assertSame(\Session::userId(), $user->getKey());
    }
}
