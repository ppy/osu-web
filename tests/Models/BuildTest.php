<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models;

use App\Models\Build;
use App\Models\Repository;
use App\Models\UpdateStream;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class BuildTest extends TestCase
{
    public static function dataProviderForImportFromGithubNewReleaseSetsAllowBanchoCorrectly(): array
    {
        return [
            [true],
            [false],
        ];
    }

    #[DataProvider('dataProviderForImportFromGithubNewReleaseSetsAllowBanchoCorrectly')]
    public function testImportFromGithubNewReleaseSetsAllowBanchoCorrectly(bool $allowBancho)
    {
        $stream = UpdateStream::create([
            'name' => 'teststream',
            'pretty_name' => 'test stream',
            'default_allow_bancho' => $allowBancho,
        ]);
        $repository = Repository::create([
            'build_on_release' => true,
            'name' => 'test-repository',
            'stream_id' => $stream->getKey(),
        ]);

        $this->expectCountChange(fn () => $stream->builds()->count(), 1);

        $build = Build::importFromGithubNewRelease([
            'repository' => ['full_name' => $repository->name],
            'release' => [
                'created_at' => json_time(new \DateTime()),
                'tag_name' => '2020.101.0',
            ],
        ]);

        $this->assertNotNull($build);
        $this->assertSame($allowBancho, $build->allow_bancho);
    }
}
