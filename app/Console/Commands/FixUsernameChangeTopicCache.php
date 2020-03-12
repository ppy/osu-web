<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class FixUsernameChangeTopicCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:username-change-topic-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Topic cache from username changes changing wrong field';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = $this->confirm('WARNING! This will refresh the cache for forum topics effected by username changes after 2017/08/09');

        if (!$continue) {
            return $this->error('User aborted!');
        }

        $start = time();

        $date = Carbon::parse('2017/08/09');
        $ids = UsernameChangeHistory::where('timestamp', '>', $date)
            ->distinct()
            ->pluck('user_id'); // pluck is faster than select for this.

        $userCount = count($ids);
        $this->warn("{$userCount} users effected");

        // where the user is the topic creator.
        $this->info('Getting first poster counts...');
        $topicsFirstPoster = Topic::withTrashed()->whereIn('topic_poster', $ids);
        $count = $topicsFirstPoster->count();
        $this->warn("Found {$count}");

        // topics where they posted in - possible last posts.
        // select is faster than pluck for the the whereNotIn().
        $this->info('Getting possible last poster counts...');
        $topicIds = Post::withTrashed()
            ->whereIn('poster_id', $ids)
            ->whereNotIn('topic_id', (clone $topicsFirstPoster)->select('topic_id'))
            ->distinct()
            ->pluck('topic_id');

        $count += $topicIds->count();
        $this->warn("Total {$count}");

        $this->warn((time() - $start).'s to scan.');

        // reconfirm.
        if (!$this->confirm("This will affect an estimated {$count} Topics.")) {
            return $this->error('User aborted!');
        }

        $start = time();
        $bar = $this->output->createProgressBar($count);

        $this->chunkAndProcess($topicsFirstPoster->pluck('topic_id')->toArray(), $bar);
        $this->warn("\n".(time() - $start).'s taken.');

        $this->chunkAndProcess($topicIds->toArray(), $bar);
        $bar->finish();

        $this->warn("\n".(time() - $start).'s taken.');
    }

    private function chunkAndProcess($array, $bar)
    {
        // This is a lot faster than Laravel's whereIn()->chunk for the number of records here.
        // chunk() freezes every 1000 records as it queries and offsets.
        $chunks = array_chunk($array, 1000);
        foreach ($chunks as $chunk) {
            $this->processChunk($chunk, $bar);
        }
    }

    private function processChunk($chunk, $bar)
    {
        $topics = Topic::withTrashed()->whereIn('topic_id', $chunk)->get();
        foreach ($topics as $topic) {
            try {
                if ($topic->topic_poster) {
                    $user = User::withoutGlobalScopes()->select('username')->find($topic->topic_poster);
                    if ($user) {
                        $username = $user->username;
                        if ($topic->topic_first_poster_name !== $username) {
                            $topic->update(['topic_first_poster_name' => $username]);
                        }
                    } else {
                        $this->warn("topic_poster not found for Topic {$topic->topic_id}");
                    }
                }
            } catch (Exception $e) {
                $this->error("Exception caught, Topic {$topic->topic_id}");
                $this->error($e->getMessage());
            }

            $bar->advance();
        }
    }
}
