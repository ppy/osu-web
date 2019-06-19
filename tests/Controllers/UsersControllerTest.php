<?php

use App\Models\Country;
use App\Models\User;

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
            ->assertRedirect(route('users.show', ['user' => $user->getKey()]));
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
            ->assertRedirect(route('users.show', ['user' => $user2->getKey()]));
    }
}
