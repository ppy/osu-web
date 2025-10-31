<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Libraries\Score;

use App\Interfaces\ScoreReplayFileInterface;
use App\Models\Solo\Score;
use Illuminate\Contracts\Filesystem\Filesystem;

class ReplayFile implements ScoreReplayFileInterface
{
    private string $path;

    public function __construct(private Score $score)
    {
        $this->path = (string) $score->getKey();
    }

    public function delete(): void
    {
        $this->storage()->delete($this->path);
    }

    public function get(): ?string
    {
        return $this->storage()->get($this->path);
    }

    public function put(string $content): void
    {
        $this->storage()->put($this->path, $content);
    }

    private function storage(): Filesystem
    {
        return \Storage::disk("{$GLOBALS['cfg']['filesystems']['default']}-solo-replay");
    }
}
