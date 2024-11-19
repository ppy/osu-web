<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TagsControllerTest extends TestCase
{
    private Tag $tag;

    public function testIndex(): void
    {
        $this->actAsScopedUser(User::factory()->create(), ['public']);

        $this
            ->get(route('api.tags.index'))
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->where('tags.0.id', $this->tag->getKey())
                    ->etc());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->tag = Tag::factory()->create();
    }
}
