<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Controllers;

use App\Models\Contest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Testing\File;
use Tests\TestCase;

class ContestEntriesControllerTest extends TestCase
{
    private Contest $contest;
    private User $user;

    public function testStoreEntryWithWrongFileExtension()
    {
        $this->prepareForStore();
        $file = File::fake()->create('entry.osz');

        $this
            ->actingAsVerified($this->user)
            ->postJson(route('contest-entries.store'), ['entry' => $file, 'contest_id' => $this->contest->id])
            ->assertStatus(422)
            ->assertJson(['error' => 'Files for this contest must have one of the following extensions: jpg, jpeg, png']);
    }

    public function testStoreEntryExceedingMaxFileSize()
    {
        $this->prepareForStore();
        $file = File::fake()->create('test.png', 8 * 1024 * 1024 * 2);

        $this
            ->actingAsVerified($this->user)
            ->postJson(route('contest-entries.store'), ['entry' => $file, 'contest_id' => $this->contest->id])
            ->assertStatus(413)
            ->assertJson(['error' => 'File exceeds max size']);
    }

    public function testStoreEntryWithWrongForcedDimensions()
    {
        $this->prepareForStore();
        $file = File::image('entry.png', 1600, 900);

        $this
            ->actingAsVerified($this->user)
            ->postJson(route('contest-entries.store'), ['entry' => $file, 'contest_id' => $this->contest->id])
            ->assertStatus(422)
            ->assertJson(['error' => 'Images for this contest must be 1920x1080']);
    }

    public function testStoreEntryWithCorrectRequirements()
    {
        $this->prepareForStore();
        $file = File::image('test.png', 1920, 1080);

        $this
            ->actingAsVerified($this->user)
            ->postJson(route('contest-entries.store'), ['entry' => $file, 'contest_id' => $this->contest->id])
            ->assertStatus(200);
    }

    private function prepareForStore()
    {
        $this->user = User::factory()->create();
        $this->contest = Contest::create([
            'name' => 'Test',
            'description_enter' => 'This is just a test!',
            'description_voting' => 'This is just a test!',
            'entry_starts_at' => Carbon::now(),
            'entry_ends_at' => Carbon::now()->addDays(),
            'extra_options' => ['forced_width' => 1920, 'forced_height' => 1080],
            'header_url' => 'https://assets.ppy.sh/contests/154/header.jpg',
            'max_entries' => 1,
            'max_votes' => 1,
            'show_votes' => true,
            'type' => 'art',
            'visible' => true,
            'voting_ends_at' => Carbon::now()->addDays(2),
            'voting_starts_at' => Carbon::now()->addDays(3),
        ]);
    }
}
