<?php

use App\Libraries\UserVerification;
use App\Models\User;

class AccountControllerTest extends TestCase
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
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('POST', route('account.update-profile'), [
                'order' => ['historical', 'medals', 'beatmaps', 'top_ranks', 'kudosu', 'recent_activities', 'me', 'performance'],
                ])
            ->seeJson([
                'profileOrder' => ['historical', 'medals', 'beatmaps', 'top_ranks', 'kudosu', 'recent_activities', 'me', 'performance'],
            ]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('POST', route('account.update-profile'), [
                'order' => ['me', 'recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical', 'performance', 'me'],
            ])
            ->seeJson([
                'error' => trans('errors.account.profile-order.generic'),
            ]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('POST', route('account.update-profile'), [
                'order' => ['me', 'recent_activities', 'kudosu', 'top_ranks', 'beatmaps', 'medals', 'historical', 'performance', 'test'],
            ])
            ->seeJson([
                'error' => trans('errors.account.profile-order.generic'),
            ]);
    }
}
