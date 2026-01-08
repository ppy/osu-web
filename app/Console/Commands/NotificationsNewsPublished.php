<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Jobs\Notifications\NewsPostNew;
use App\Models\Count;
use App\Models\NewsPost;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class NotificationsNewsPublished extends Command
{
    protected $signature = 'notifications:news-published';
    protected $description = 'Send recent published News post notifications';

    public function handle()
    {
        $lastTimestampRow = Count::lastNewsPostPublishedAtNotified();
        $publishedAt = CarbonImmutable::parse($lastTimestampRow->count);
        $pending = NewsPost::published()->where('published_at', '>', $publishedAt)->orderBy('published_at')->get();

        $this->line("Sending notifications for published News posts after {$publishedAt}");

        $pending->each(function ($newsPost) use ($lastTimestampRow) {
            $this->line($newsPost->slug);
            new NewsPostNew($newsPost)->dispatch();
            $lastTimestampRow->update(['count' => $newsPost->published_at->timestamp]);
        });
    }
}
