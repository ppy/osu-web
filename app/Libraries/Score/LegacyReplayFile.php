<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Score;

use App\Exceptions\InvariantException;
use App\Interfaces\ScoreReplayFileInterface;
use App\Models\Solo\Score;
use Illuminate\Contracts\Filesystem\Filesystem;

class LegacyReplayFile implements ScoreReplayFileInterface
{
    const DEFAULT_VERSION = 20151228;

    public function __construct(private Score $score)
    {
    }

    public function delete(): void
    {
        $this->storage()->delete($this->path());
    }

    /**
     * Generates the end chunk for replay files.
     *
     * @return string Binary string of the chunk.
     */
    public function endChunk()
    {
        return pack('q', $this->score->legacy_best_id);
    }

    public function get(): ?string
    {
        $body = $this->storage()->get($this->path());

        return $body === null
            ? null
            : $this->headerChunk()
                .pack('i', strlen($body))
                .$body
                .$this->endChunk();
    }

    public function getVersion()
    {
        return $this->score->legacyReplayViewCount?->version ?? static::DEFAULT_VERSION;
    }

    /**
     * Generates the header chunk for replay files.
     *
     * @return string Binary string of the chunk.
     */
    public function headerChunk(): string
    {
        $legacyScore = $this->score->makeLegacyEntry();
        $beatmap = $this->score->beatmap ?? $this->score->beatmap()->withTrashed()->first();

        if ($beatmap === null) {
            throw new InvariantException('score is missing beatmap');
        }

        $user = $this->score->user;

        if ($user === null) {
            throw new InvariantException('score is missing user');
        }

        $md5 = md5("{$legacyScore->maxcombo}osu{$user->username}{$beatmap->checksum}{$legacyScore->score}{$legacyScore->rank}");
        $ticks = $legacyScore->date->timestamp * 10000000 + 621355968000000000; // Conversion to dotnet DateTime.Ticks.

        // easier debugging with array and implode instead of plain string concatenation.
        $components = [
            pack('c', $this->score->ruleset_id),
            pack('i', $this->getVersion()),
            pack_str($beatmap->checksum),
            pack_str($user->username),
            pack_str($md5),
            pack('S', $legacyScore->count300),
            pack('S', $legacyScore->count100),
            pack('S', $legacyScore->count50),
            pack('S', $legacyScore->countgeki),
            pack('S', $legacyScore->countkatu),
            pack('S', $legacyScore->countmiss),
            pack('i', $legacyScore->score),
            pack('S', $legacyScore->maxcombo),
            pack('c', $legacyScore->perfect),
            pack('i', $legacyScore->getAttributes()['enabled_mods']),
            pack_str(''), // outputs 0b00 from site, 00 if exported from game client.
            pack('q', $ticks),
        ];

        return implode('', $components);
    }

    public function put(string $content): void
    {
        $this->storage()->put($this->path(), $content);
    }

    private function path(): string
    {
        return (string) $this->score->legacy_best_id;
    }

    private function storage(): Filesystem
    {
        $disk = "{$GLOBALS['cfg']['filesystems']['default']}-legacy-replay-{$this->score->getMode()}";

        return \Storage::disk($disk);
    }
}
