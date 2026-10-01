<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\User;

use App\Libraries\User\PasswordHelper;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class PasswordHelperTest extends TestCase
{
    public function testBasicHashing()
    {
        $value = PasswordHelper::make('password');

        $this->assertNotSame('password', $value);
        $this->assertNotSame(md5('password'), $value);

        $user = new User(['user_password' => $value]);

        $this->assertTrue(PasswordHelper::check($user, 'password'));
    }
}
