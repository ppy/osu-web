<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Transformers;

use App\Models\LovedPoll;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class LovedPollTransformerTest extends TestCase
{
    public function testCurrentUserAttributesNotVisibleWhenOAuth(): void
    {
        $this->actAsScopedUser(User::factory()->create());

        $lovedPollJson = json_item(LovedPoll::factory()->create(), 'LovedPoll');

        $this->assertArrayNotHasKey('current_user_attributes', $lovedPollJson);
    }

    public function testCurrentUserAttributesVisibleWhenGuest(): void
    {
        $lovedPollJson = json_item(LovedPoll::factory()->create(), 'LovedPoll');

        $this->assertArrayHasKey('current_user_attributes', $lovedPollJson);
    }

    public function testCurrentUserAttributesVisibleWhenNotOAuth(): void
    {
        $this->actAsUser(User::factory()->create());

        $lovedPollJson = json_item(LovedPoll::factory()->create(), 'LovedPoll');

        $this->assertArrayHasKey('current_user_attributes', $lovedPollJson);
    }

    public function testResultsNotNullWhenPollEnded(): void
    {
        $lovedPoll = LovedPoll::factory()->create();
        $lovedPoll->topic->poll_start = Carbon::now()->subYear();

        $lovedPollJson = json_item($lovedPoll, 'LovedPoll');

        $this->assertArrayHasKey('results', $lovedPollJson);
        $this->assertNotNull($lovedPollJson['results']);
    }

    public function testResultsNullWhenPollNotEnded(): void
    {
        $lovedPoll = LovedPoll::factory()->create();
        $lovedPoll->topic->poll_start = Carbon::now();

        $lovedPollJson = json_item($lovedPoll, 'LovedPoll');

        $this->assertArrayHasKey('results', $lovedPollJson);
        $this->assertNull($lovedPollJson['results']);
    }
}
