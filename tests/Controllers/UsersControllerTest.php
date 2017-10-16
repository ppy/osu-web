<?php

use App\Models\Country;

class UsersControllerTest extends TestCase
{
    /**
     * Checks whether an OK status is returned when the
     * profile order update request is valid.
     */
    public function testStore()
    {
        // normally succeeds
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

        // with country
        $country = factory(Country::class)->create();
        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user2',
                    'user_email' => 'user2@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
                'HTTP_CF_IPCOUNTRY' => $country->getKey(),
            ])->assertJsonFragment([
                'username' => 'user2',
                'country' => [
                    'code' => $country->getKey(),
                    'name' => $country->name,
                ],
            ]);

        // no duplicate user
        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'user_email' => 'user1new@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertJsonFragment([
                'form_error' => [
                    'user' => ['username' => [trans('model_validation.user.unknown_duplicate')]],
                ],
            ]);

        // no duplicate email
        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1new',
                    'user_email' => 'user1@example.com',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertJsonFragment([
                'form_error' => [
                    'user' => ['user_email' => [trans('model_validation.user.email_already_used')]],
                ],
            ]);

        // requires username
        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => '',
                    'user_email' => 'user1new1@example.com1',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertJsonFragment([
                'form_error' => [
                    'user' => ['username' => [trans('model_validation.user.username_too_short')]],
                ],
            ]);

        // requires email
        $this
            ->json('POST', route('users.store'), [
                'user' => [
                    'username' => 'user1',
                    'password' => 'hunter22',
                ],
            ], [
                'HTTP_USER_AGENT' => config('osu.client.user_agent'),
            ])->assertJsonFragment([
                'form_error' => [
                    'user' => ['username' => [trans('model_validation.user.unknown_duplicate')]],
                ],
            ]);
    }
}
