<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function testUserPageDisplayedOnLoggedInUser()
    {
        $this->actingAs($this->user)
            ->visit('/u/'.$this->user->user_id)
            ->see('"profileOrder":["me","performance","recent_activities","top_ranks","medals","historical","beatmaps","kudosu"]');
    }
}
