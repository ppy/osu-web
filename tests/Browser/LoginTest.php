<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    /**
     * Test sign in.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(\App\Models\User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->resize(1024, 768); // ensure desktop layout

            $browser->visit('/')
                ->clickLink('Sign in')
                ->type('username', $user->user_email)
                ->type('password', 'password')
                ->press('Sign in')
                ->waitFor('.osu-page-header--home-user')
                ->assertPathIs('/home')
                ->assertSee("Hello, {$user->username}!")
                ->assertDontSee('Incorrect sign in');
        });
    }

    /**
     * Test sign out.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = factory(\App\Models\User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->resize(1024, 768); // ensure desktop layout

            $browser->loginAs($user)
                ->visit('/')
                ->click('.js-user-login--menu') // bring up user menu
                ->click('.js-user-header-popup .js-logout-link') // click the logout 'button'
                ->acceptDialog()
                ->pause(5000) // todo: replace with some other waitFor?
                ->assertPathIs('/home')
                ->assertVisible('.landing-hero');
        });
    }
}
