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
        $newOrder = [
            'historical',
            'medals',
            'beatmaps',
            'top_ranks',
            'kudosu',
            'recent_activities',
            'me',
            'performance',
        ];

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrder,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $newOrder = [
            'me',
            'recent_activities',
            'kudosu',
            'top_ranks',
            'beatmaps',
            'medals',
            'historical',
            'performance',
        ];

        $newOrderWithDuplicate = $newOrder;
        $newOrderWithDuplicate[] = 'me';

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrderWithDuplicate,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $newOrder = [
            'me',
            'recent_activities',
            'kudosu',
            'top_ranks',
            'beatmaps',
            'medals',
            'historical',
            'performance',
        ];

        $newOrderWithInvalid = $newOrder;
        $newOrderWithInvalid[] = 'test';

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrderWithInvalid,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }
}
