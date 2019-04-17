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
        config()->set('osu.user.allow_registration', true);

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
    }

    public function testStoreWithCountry()
    {
        config()->set('osu.user.allow_registration', true);

        $country = Country::inRandomOrder()->first() ?? factory(Country::class)->create();

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
    }
}
