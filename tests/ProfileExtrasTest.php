<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;

class ProfileExtrasTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * Checks whether an OK status is returned when the
     * profile order update request is valid.
     */
    public function testValidProfileOrderChangeRequest()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('PUT', route('account.update-profile'), [
                'order' => ['historical', 'medals', 'beatmaps', 'top_ranks', 'kudosu', 'recent_activities', 'me'],
                ])
            ->seeJson([
                'profileOrder' => ['historical', 'medals', 'beatmaps', 'top_ranks', 'kudosu', 'recent_activities', 'me'],
            ]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('PUT', route('account.update-profile'), [
                'order' => ['me', 'recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical', 'me'],
            ])
            ->seeJson([
                'error' => trans('errors.account.profile-order.generic'),
            ]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('PUT', route('account.update-profile'), [
                'order' => ['me', 'recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical', 'test'],
            ])
            ->seeJson([
                'error' => trans('errors.account.profile-order.generic'),
            ]);
    }

    public function testUserPageDisplayedOnLoggedInUser()
    {
        $this->actingAs($this->user)
            ->visit('/u/'.$this->user->user_id)
            ->see('"profileOrder":["me","recent_activities","kudosu","top_ranks","beatmaps","medals","historical"]');
    }

    public function testUserPageNotDisplayedOnOtherUsers()
    {
        $visitedUser = factory(User::class)->create();

        $this->actingAs($this->user)
            ->visit('/u/'.$visitedUser->user_id)
            ->see('"profileOrder":["recent_activities","kudosu","top_ranks","beatmaps","medals","historical"]');
    }
}
