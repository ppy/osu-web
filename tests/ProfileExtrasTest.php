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
            ->json('POST', '/account/update-profile-order', [
                'order' => [7,6,5,4,3,2,1],
                ])
            ->seeJson([
                'status' => 'OK'
            ]);
    }

    public function testDuplicatesInProfileOrder()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('POST', '/account/update-profile-order', [
                'order' => [1,2,3,4,5,6,7,1],
            ])
            ->seeJson([
                'status' => 'error',
                'errors' => [trans('errors.account.profile-order.duplicate')]
            ]);
    }

    public function testInvalidIdsInProfileOrder()
    {
        $this->withoutMiddleware();

        $this->actingAs($this->user)
            ->json('POST', '/account/update-profile-order', [
                'order' => [1,2,3,4,5,6,7,8],
            ])
            ->seeJson([
                'status' => 'error',
                'errors' => [trans('errors.account.profile-order.invalid-id', ['count' => 7])]
            ]);
    }
}
