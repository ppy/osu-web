<?php

use App\Libraries\UserVerification;
use App\Models\User;
use App\Models\UserProfileCustomization;

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
        $newOrder = UserProfileCustomization::SECTIONS;
        seeded_shuffle($newOrder);

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrder,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $newOrder = UserProfileCustomization::SECTIONS;

        $newOrderWithDuplicate = $newOrder;
        $newOrderWithDuplicate[] = $newOrder[0];

        $this->actingAs($this->user)
            ->withSession(['verified' => UserVerification::VERIFIED])
            ->json('PUT', route('account.update'), [
                'order' => $newOrderWithDuplicate,
            ])
            ->assertJsonFragment(['profileOrder' => $newOrder]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $newOrder = UserProfileCustomization::SECTIONS;

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
