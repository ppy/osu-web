<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AccountTest extends DuskTestCase
{
    public function testUpdatePassword(): void
    {
        $userFactory = User::factory();

        $password = 'password';
        $user = $userFactory->create();

        $this->browse(function (Browser $browserMain, Browser $browserOther) use ($password, $user) {
            $doAll = function ($callback) use ($browserMain, $browserOther) {
                $callback($browserMain);
                $callback($browserOther);
            };

            $doAll(fn ($browser) => (
                $browser->visit('/')
                    ->clickLink('Sign in')
                    ->type('username', $user->user_email)
                    ->type('password', $password)
                    ->press('Sign in')
            ));

            $doAll(fn ($browser) => $browser->waitFor('.user-home'));

            $newPassword = str_random(20);

            $browserMain->visit('/_dusk/verify')
                ->visitRoute('account.edit')
                ->type('.js-password-update input[name="user[current_password]"]', $password)
                ->type('.js-password-update input[name="user[password]"]', $newPassword)
                ->type('.js-password-update input[name="user[password_confirmation]"]', $newPassword)
                ->press('.js-password-update button[type=submit]')
                ->clickLink('home')
                ->waitFor('.user-home');

            $browserOther
                ->visit('/')
                ->assertVisible('.landing-hero');
        });
    }
}
