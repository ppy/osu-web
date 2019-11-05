<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Tests\Libraries;

use App\Mail\UserVerification;
use App\Models\User;
use App\Models\UserClient;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class VerificationTest extends TestCase
{
    public function testUserVerification()
    {
        $this->initVerification()
            ->assertSee('Account Verification')
            ->assertSessionHas('verification_key')
            ->assertSessionHas('verification_tries')
            ->assertSessionHas('verification_expire_date')
            ->assertSessionHas('verification_link_key');

        $response = $this->actingAs($this->user)
            ->withSession(['verification_key' => '12345678'])
            ->post(route('account.verify', [
                'type' => 'user',
                'verification_key' => '12345678',
            ]))
            ->assertSuccessful();

        $this->assertVerified($response);
    }

    public function testVerificationFailed()
    {
        $this->initVerification();

        $response = $this->actingAs($this->user)
            ->withSession(['verification_key' => '12345678'])
            ->post(route('account.verify', [
                'type' => 'user',
                'verification_key' => '87654321',
            ]))
            ->assertStatus(422)
            ->assertSee('Incorrect verification code.');

        $this->assertNotVerified($response);
    }

    public function testVerificationExpired()
    {
        $this->initVerification();

        $response = $this->actingAs($this->user)
            ->withSession([
                'verification_expire_date' => now()->subHour(),
                'verification_key' => '12345678',
            ])
            ->post(route('account.verify', [
                'type' => 'user',
                'verification_key' => '12345678',
            ]))
            ->assertStatus(422)
            ->assertSee('Verification code expired, new verification email sent.');

        $this->assertNotVerified($response);
    }

    public function testVerificationRetriesExceeded()
    {
        $this->initVerification();

        $response = $this->actingAs($this->user)
            ->withSession([
                'verification_tries' => 9,
                'verification_key' => '12345678',
            ])
            ->post(route('account.verify', [
                'type' => 'user',
                'verification_key' => '87654321',
            ]))
            ->assertStatus(422)
            ->assertSee('Incorrect verification code. Retry limit exceeded, new verification email sent.');

        $this->assertNotVerified($response);
    }

    public function testReissue()
    {
        Mail::fake();

        $this->initVerification();

        $this->actingAs($this->user)
            ->withSession(['verification_key' => '12345678'])
            ->post(route('account.reissue-code'))
            ->assertSuccessful()
            ->assertSee('Verification code reissued, new verification email sent.');

        Mail::assertQueued(UserVerification::class);
    }

    public function testReissueAlreadyVerified()
    {
        $this->initVerification();

        Mail::fake();

        $this->actingAs($this->user)
            ->withSession(['verified' => true])
            ->post(route('account.reissue-code'))
            ->assertSuccessful();

        Mail::assertNotQueued(UserVerification::class);
    }

    public function testClientVerification()
    {
        // all hashes are 0123456789abcdef
        $client_hash = '30313233343536373839616263646566::30313233343536373839616263646566:30313233343536373839616263646566:30313233343536373839616263646566';

        $this->actingAs($this->user)
            ->get(route('account.verify-client', [
                'client_hash' => $client_hash,
            ]))
            ->assertSee('Client Verification')
            ->assertSessionHas('client_hash', $client_hash);

        $response = $this->actingAs($this->user)
            ->withSession(['verification_key' => '12345678'])
            ->post(route('account.verify', [
                'type' => 'client',
                'verification_key' => '12345678',
            ]))
            ->assertSuccessful()
            ->assertSessionMissing('client_hash');

        // regular website session should also be set to verified if it
        // wasn't previously (eg. never logged in prior to verifying the)
        // client on this PC/browser)
        $this->assertVerified($response);

        $client = UserClient::fromHash($this->user->user_id, $client_hash);

        $this->assertTrue($client->verified);
    }

    private function assertVerified($response)
    {
        $response
            ->assertSessionHas('verified', true)
            ->assertSessionMissing('verification_key')
            ->assertSessionMissing('verification_tries')
            ->assertSessionMissing('verification_expire_date');
    }

    private function assertNotVerified($response)
    {
        $response
            ->assertSessionMissing('verified')
            ->assertSessionHas('verification_key')
            ->assertSessionHas('verification_tries')
            ->assertSessionHas('verification_expire_date');
    }

    private function initVerification()
    {
        return $this->actingAs($this->user)->get(route('account.edit'));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
}
