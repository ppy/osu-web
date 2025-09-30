<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Controllers;

use App\Models\BeatmapsetVersionFile;
use App\Models\User;
use Tests\TestCase;

class BeatmapsetVersionFilesControllerTest extends TestCase
{
    public function testDownload(): void
    {
        $versionFile = BeatmapsetVersionFile::factory()->create();
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('beatmapset-version-files.download', ['beatmapset_version_file' => $versionFile->getKey()]))
            ->assertDownload();

        $this->assertSame(bin2hex($versionFile->file->sha2_hash), hash('sha256', $response->streamedContent()));
    }

    public function testDownloadAsGuest(): void
    {
        $versionFile = BeatmapsetVersionFile::factory()->create();

        $this
            ->get(route('beatmapset-version-files.download', ['beatmapset_version_file' => $versionFile->getKey()]))
            ->assertStatus(401);
    }
}
