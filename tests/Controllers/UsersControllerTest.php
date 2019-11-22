<?php

namespace Tests\Controllers;

use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * Checks whether an OK status is returned when the
     * profile order update request is valid.
     */
    public function testStore()
    {
        $previousCount = User::count();

        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertJsonFragment([
                'username' => 'user1',
            ]);

        $this->assertSame($previousCount + 1, User::count());
    }

    /**
     * Passing check=1 only validates user and not create.
     */
    public function testStoreDryRunValid()
    {
        $previousCount = User::count();

        $this
            ->json('POST', route('users.store'), [
                'check' => '1',
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertSuccessful();

        $this->assertSame($previousCount, User::count());
    }

    /**
     * Invalid parameter returns 422.
     */
    public function testStoreInvalid()
    {
        $previousCount = User::count();

        $this
            ->json('POST', route('users.store'), [
                'check' => '1',
                'user' => [
                    'username' => '',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertStatus(422)
            ->assertJsonFragment([
                'form_error' => ['user' => ['username' => ['Username is required.']]],
            ]);

        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => '',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertStatus(422)
            ->assertJsonFragment([
                'form_error' => ['user' => ['username' => ['Username is required.']]],
            ]);

        $this->assertSame($previousCount, User::count());
    }

    public function testStoreWithCountry()
    {
        $country = Country::inRandomOrder()->first() ?? factory(Country::class)->create();

        $previousCount = User::count();

        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
                'HTTP_CF_IPCOUNTRY' => $country->getKey(),
            ])->assertJsonFragment([
                'username' => 'user1',
                'country' => [
                    'code' => $country->getKey(),
                    'name' => $country->name,
                ],
            ]);

        $this->assertSame($previousCount + 1, User::count());
    }

    /**
     * Disable registration for logged in user.
     */
    public function testStoreLoggedIn()
    {
        $user = factory(User::class)->create();

        $previousCount = User::count();

        $this
            ->actingAsVerified($user)
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertStatus(302);

        $this->assertSame($previousCount, User::count());
    }

    public function testPreviousUsernameShouldRedirect()
    {
        $oldUsername = 'potato';
        $newUsername = 'carrot';

        /** @var User $user */
        $user = factory(User::class)->create([
            'osu_subscriptionexpiry' => now()->addDay(),
            'username' => $oldUsername,
            'username_clean' => $oldUsername,
        ]);
        $user->changeUsername($newUsername, 'paid');

        $this
            ->get(route('users.show', ['user' => $oldUsername]))
            ->assertRedirect(route('users.show', ['user' => $user->getKey(), 'mode' => null]));
    }

    public function testPreviousUsernameTakenShouldNotRedirect()
    {
        $oldUsername = 'potato';
        $newUsername = 'carrot';

        /** @var User $user1 */
        $user1 = factory(User::class)->create([
            'osu_subscriptionexpiry' => now()->addDay(),
            'username' => $oldUsername,
            'username_clean' => $oldUsername,
        ]);
        $user1->changeUsername($newUsername, 'paid');

        $user2 = factory(User::class)->create([
            'username' => $oldUsername,
            'username_clean' => $oldUsername,
        ]);

        $this
            ->get(route('users.show', ['user' => $oldUsername]))
            ->assertRedirect(route('users.show', ['user' => $user2->getKey(), 'mode' => null]));
    }
}
