<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * Test sign in.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/')
                ->clickLink('Sign in')
                ->type('username', $user->user_email)
                ->type('password', 'password') // User factory generates users with the password hardcoded as 'password'
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
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/')
                ->click('.js-user-login--menu') // bring up user menu
                ->click('.js-user-header-popup .js-logout-link') // click the logout 'button'
                ->acceptDialog()
                ->waitFor('.landing-hero__bg-container')
                ->assertPathIs('/home')
                ->assertVisible('.landing-hero');
        });
    }
}
