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
            ->json('POST', route('account.update-profile'), [
                'order' => ['historical', 'medals', 'beatmaps', 'top_ranks', 'kudosu', 'recent_activities', 'me', 'performance'],
                ])
            ->seeJson([
                'profileOrder' => ['historical', 'medals', 'beatmaps', 'top_ranks', 'kudosu', 'recent_activities', 'me', 'performance'],
            ]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('POST', route('account.update-profile'), [
                'order' => ['me', 'recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical', 'performance', 'me'],
            ])
            ->seeJson([
                'error' => trans('errors.account.profile-order.generic'),
            ]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('POST', route('account.update-profile'), [
                'order' => ['me', 'recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical', 'performance', 'test'],
            ])
            ->seeJson([
                'error' => trans('errors.account.profile-order.generic'),
            ]);
    }

    public function testUserPageDisplayedOnLoggedInUser()
    {
        $this->actingAs($this->user)
            ->visit('/u/'.$this->user->user_id)
            ->see('"profileOrder":["me","performance","recent_activities","top_ranks","medals","historical","beatmaps","kudosu"]');
    }
}
