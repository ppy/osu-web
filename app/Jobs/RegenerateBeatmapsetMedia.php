<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Jobs;

use App\Exceptions\BeatmapProcessorException;
use App\Exceptions\SilencedException;
use App\Models\Beatmapset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RegenerateBeatmapsetMedia implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300;

    public function __construct(protected Beatmapset $beatmapset)
    {
    }

    public function displayName()
    {
        return static::class." (Beatmapset {$this->beatmapset->getKey()})";
    }

    public function handle()
    {
        $this->runTask(
            'regenerate_beatmapset_cover',
            fn () => $this->beatmapset->regenerateCovers(),
        );
        $this->runTask(
            'regenerate_beatmapset_preview',
            fn () => $this->beatmapset->regenerateAudioPreview(),
        );
    }

    private function runTask(string $task, callable $taskFn): void
    {
        try {
            $taskFn();
            datadog_increment("{$task}.ok");
        } catch (\Throwable $e) {
            datadog_increment("{$task}.error");
            log_error(new BeatmapProcessorException(previous: $e), [
                'task' => $task,
                'id' => $this->beatmapset->getKey(),
            ]);
            throw new SilencedException(previous: $e);
        }
    }
}
