<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Forum\TopicCover;
use Illuminate\Console\Command;

class ForumTopicCoversCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:topic-cover-cleanup {--maxdays=} {--yes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused topic covers.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $createdBefore = now()->subDays(get_int($this->option('maxdays')) ?? 30);
        $this->line("This will delete unused topic covers before {$createdBefore}.");

        if (!$this->option('yes') && !$this->confirm('Proceed?')) {
            return $this->error('Aborted.');
        }

        $progress = $this->output->createProgressBar();
        $deleted = 0;

        TopicCover::whereNull('topic_id')->chunkById(1000, function ($coversChunk) use ($createdBefore, $progress, &$deleted) {
            foreach ($coversChunk as $cover) {
                if ($cover->created_at > $createdBefore) {
                    // we're done, exit loop and chunkById
                    return false;
                }

                $deleted++;
                $progress->advance();
                $cover->deleteWithFile();
            }
        });

        $this->line('');
        $this->info("Done. Deleted {$deleted} cover(s).");
    }
}
