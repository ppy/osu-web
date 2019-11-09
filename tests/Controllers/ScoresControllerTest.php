<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace Tests\Controllers;

use App\Models\Score\Best\Osu;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use Storage;
use Tests\TestCase;

class ScoresControllerTest extends TestCase
{
    private $score;
    private $user;

    public function testDownload()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'GET',
                route('scores.download', ['mode' => 'osu', 'score' => $this->score->getKey()])
            )
            ->assertSuccessful();
    }

    public function testDownloadInvalidMode()
    {
        $this
            ->actingAs($this->user)
            ->json(
                'GET',
                route('scores.download', ['mode' => 'nope', 'score' => $this->score->getKey()])
            )
            ->assertStatus(404);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // fake all the replay disks
        $disks = [];
        foreach (array_keys(config('filesystems.disks.replays')) as $key) {
            foreach (array_keys(config("filesystems.disks.replays.{$key}")) as $type) {
                $disk = "replays.{$key}.{$type}";
                $disks[] = $disk;
                Storage::fake($disk);
            }
        }

        // Laravel doesn't remove the directory created for fakes and
        // Storage::fake() removes the files in the directory when called but leaves the directory there.
        $this->beforeApplicationDestroyed(function () use ($disks) {
            foreach ($disks as $disk) {
                $path = storage_path('framework/testing/disks/'.$disk);
                (new Filesystem)->deleteDirectory($path);
            }
        });

        $this->user = factory(User::class)->create();
        $this->score = factory(Osu::class)->states('with_replay')->create();
    }
}
