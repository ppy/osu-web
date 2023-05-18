<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Country;
use App\Models\User;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    public function testIndexForApi()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $this->actAsScopedUser($user, ['*']);

        $this
            ->get(route('api.users.index', ['ids' => [$user->getKey(), $userB->getKey()]]))
            ->assertSuccessful()
            ->assertJsonPath('users.0.id', $user->getKey())
            ->assertJsonPath('users.1.id', $userB->getKey());
    }

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
                'country_code' => Country::UNKNOWN,
            ]);

        $this->assertSame($previousCount + 1, User::count());
    }

    public function testStoreRegModeWeb()
    {
        config()->set('osu.user.registration_mode', 'web');
        $this->expectCountChange(fn () => User::count(), 0);

        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertStatus(403)
            ->assertJsonFragment([
                'error' => osu_trans('users.store.from_web'),
            ]);
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

    public function testStoreWebRegModeClient()
    {
        $this->expectCountChange(fn () => User::count(), 0);

        $this->post(route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ])->assertStatus(403)
            ->assertJsonFragment([
                'error' => osu_trans('users.store.from_client'),
            ]);
    }

    public function testStoreWeb(): void
    {
        config()->set('osu.user.registration_mode', 'web');
        $this->expectCountChange(fn () => User::count(), 1);

        $this->post(route('users.store-web'), [
            'user' => [
                'username' => 'user1',
                'user_email' => 'user1@example.com',
                'user_email_confirmation' => 'user1@example.com',
                'password' => 'hunter22',
                'password_confirmation' => 'hunter22',
            ],
        ])->assertRedirect(route('home'));
    }

    /**
     * @dataProvider dataProviderForStoreWebInvalidParams
     */
    public function testStoreWebInvalidParams($username, $email, $emailConfirmation, $password, $passwordConfirmation): void
    {
        config()->set('osu.user.registration_mode', 'web');
        $this->expectCountChange(fn () => User::count(), 0);

        $this->post(route('users.store-web'), [
                'user' => [
                    'username' => $username,
                    'user_email' => $email,
                    'user_email_confirmation' => $emailConfirmation,
                    'password' => $password,
                    'password_confirmation' => $passwordConfirmation,
                ],
            ])->assertStatus(422);
    }

    public function testStoreWebLoggedIn(): void
    {
        config()->set('osu.user.registration_mode', 'web');
        $user = User::factory()->create();

        $this->expectCountChange(fn () => User::count(), 0);

        $this->actingAsVerified($user)->post(route('users.store-web'), [
            'user' => [
                'username' => 'user1',
                'user_email' => 'user1@example.com',
                'user_email_confirmation' => 'user1@example.com',
                'password' => 'hunter22',
                'password_confirmation' => 'hunter22',
            ],
        ])->assertRedirect('/');
    }

    public function testStoreWithCountry()
    {
        $country = Country::inRandomOrder()->first() ?? Country::factory()->create();

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
        $user = User::factory()->create();

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
        $user = User::factory()->create([
            'osu_subscriptionexpiry' => now()->addDays(),
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
        $user1 = User::factory()->create([
            'osu_subscriptionexpiry' => now()->addDays(),
            'username' => $oldUsername,
            'username_clean' => $oldUsername,
        ]);
        $user1->changeUsername($newUsername, 'paid');

        $user2 = User::factory()->create([
            'username' => $oldUsername,
            'username_clean' => $oldUsername,
        ]);

        $this
            ->get(route('users.show', ['user' => $oldUsername]))
            ->assertRedirect(route('users.show', ['user' => $user2->getKey(), 'mode' => null]));
    }

    public function testUsernameRedirectToId()
    {
        $user = User::factory()->create();

        $this
            ->get(route('users.show', ['user' => $user->username]))
            ->assertRedirect(route('users.show', ['user' => $user->getKey()]));
    }

    public function testUsernameRedirectToIdForApi()
    {
        $user = User::factory()->create();

        $this->actAsScopedUser($user, ['public']);

        $this
            ->get(route('api.users.show', ['user' => $user->username]))
            ->assertSuccessful();
    }

    public function dataProviderForStoreWebInvalidParams(): array
    {
        return [
            ['user1', 'user@email.com', 'user@email.com', 'short', 'short'],
            ['user1', 'user@email.com', 'user@email.com', '', ''],
            ['user1', 'user@email.com', 'user@email.com', 'userpassword', 'userpassword1'],
            ['user1', 'user@email.com', 'user@email.com', 'userpassword', null],
            ['user1', 'user@email.com', 'user@email.com', null, null],

            ['user1', 'notemail@.com', 'notemail@.com', 'userpassword', 'userpassword'],
            ['user1', '', '', 'userpassword', 'userpassword'],
            ['user1', 'user@email.com', 'user1@email.com', 'userpassword', 'userpassword'],
            ['user1', 'user@email.com', null, 'userpassword', 'userpassword'],
            ['user1', null, null, 'userpassword', 'userpassword'],

            [null, 'user@email.com', 'user@email.com', 'userpassword', 'userpassword'],
            ['', 'user@email.com', 'user@email.com', 'userpassword', 'userpassword'],
            [null, 'user@email.com', 'user@email.com', null, null],
            [null, null, null, 'userpassword', 'userpassword'],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Country::factory()->fallback()->create();
    }
}
