<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\BeatmapsetVersion;
use App\Models\BeatmapsetVersionFile;
use Tests\TestCase;

class BeatmapsetVersionTest extends TestCase
{
    public function testChangeInitialVersion(): void
    {
        $n = 5;
        $versionFiles = BeatmapsetVersionFile::factory()->count($n);
        $version = BeatmapsetVersion::factory()->has($versionFiles, 'versionFiles')->create();

        $changes = $version->fresh()->changes();
        $this->assertSame($n, count($changes['added']));
        $this->assertSame(0, count($changes['removed']));
        $this->assertSame(0, count($changes['updated']));
    }

    public function testChangeAdded(): void
    {
        $initialVersionFiles = BeatmapsetVersionFile::factory()->count(2)->create();
        $initialVersion = BeatmapsetVersion::factory()->create();
        $initialVersion->versionFiles()->saveMany($initialVersionFiles);

        $addedVersionFile = BeatmapsetVersionFile::factory()->create();
        $newVersionFiles = [
            $addedVersionFile,
            ...array_map(
                fn ($versionFile) => BeatmapsetVersionFile::factory()->copyFrom($versionFile)->create(),
                $initialVersionFiles->all(),
            ),
        ];
        $newVersion = BeatmapsetVersion::factory(['previous_version_id' => $initialVersion->getKey()])->create();
        $newVersion->versionFiles()->saveMany($newVersionFiles);

        $changes = $newVersion->fresh()->changes();

        $this->assertSame(1, count($changes['added']));
        $this->assertSame($addedVersionFile->getKey(), $changes['added'][0]->getKey());
        $this->assertSame(0, count($changes['removed']));
        $this->assertSame(0, count($changes['updated']));
    }

    public function testChangeOneEach(): void
    {
        $initialVersionFiles = BeatmapsetVersionFile::factory()->count(3)->create();
        $initialVersion = BeatmapsetVersion::factory()->create();
        $initialVersion->versionFiles()->saveMany($initialVersionFiles);

        $addedVersionFile = BeatmapsetVersionFile::factory()->create();
        $updatedVersionFile = BeatmapsetVersionFile::factory(['filename' => $initialVersionFiles[0]->filename])->create();
        $removedVersionFile = $initialVersionFiles[1];
        $noChangeVersionFile = BeatmapsetVersionFile::factory()->copyFrom($initialVersionFiles[2])->create();
        $newVersionFiles = [
            $addedVersionFile,
            $updatedVersionFile,
            $noChangeVersionFile,
        ];
        $newVersion = BeatmapsetVersion::factory(['previous_version_id' => $initialVersion->getKey()])->create();
        $newVersion->versionFiles()->saveMany($newVersionFiles);

        $changes = $newVersion->fresh()->changes();

        $this->assertSame(1, count($changes['added']));
        $this->assertSame($addedVersionFile->getKey(), $changes['added'][0]->getKey());
        $this->assertSame(1, count($changes['removed']));
        $this->assertSame($removedVersionFile->getKey(), $changes['removed'][0]->getKey());
        $this->assertSame(1, count($changes['updated']));
        $this->assertSame($updatedVersionFile->getKey(), $changes['updated'][0]->getKey());
    }

    public function testChangeRemoved(): void
    {
        $initialVersionFiles = BeatmapsetVersionFile::factory()->count(2)->create();
        $initialVersion = BeatmapsetVersion::factory()->create();
        $initialVersion->versionFiles()->saveMany($initialVersionFiles);

        $removedVersionFile = $initialVersionFiles[0];
        $newVersionFiles = [BeatmapsetVersionFile::factory()->copyFrom($initialVersionFiles[1])->create()];
        $newVersion = BeatmapsetVersion::factory(['previous_version_id' => $initialVersion->getKey()])->create();
        $newVersion->versionFiles()->saveMany($newVersionFiles);

        $changes = $newVersion->fresh()->changes();

        $this->assertSame(0, count($changes['added']));
        $this->assertSame(1, count($changes['removed']));
        $this->assertSame($removedVersionFile->getKey(), $changes['removed'][0]->getKey());
        $this->assertSame(0, count($changes['updated']));
    }

    public function testChangeUpdated(): void
    {
        $initialVersionFiles = BeatmapsetVersionFile::factory()->count(2)->create();
        $initialVersion = BeatmapsetVersion::factory()->create();
        $initialVersion->versionFiles()->saveMany($initialVersionFiles);

        $updatedVersionFile = BeatmapsetVersionFile::factory(['filename' => $initialVersionFiles[0]->filename])->create();
        $otherVersionFile = BeatmapsetVersionFile::factory()->copyFrom($initialVersionFiles[1])->create();
        $newVersionFiles = [
            $updatedVersionFile,
            $otherVersionFile,
        ];
        $newVersion = BeatmapsetVersion::factory()->state(['previous_version_id' => $initialVersion->getKey()])->create();
        $newVersion->versionFiles()->saveMany($newVersionFiles);

        $changes = $newVersion->fresh()->changes();

        $this->assertSame(0, count($changes['added']));
        $this->assertSame(0, count($changes['removed']));
        $this->assertSame(1, count($changes['updated']));
        $this->assertSame($updatedVersionFile->getKey(), $changes['updated'][0]->getKey());
    }
}
