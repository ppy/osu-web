<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace App\Console\Commands;

use App\Models\Forum\Topic;
use App\Models\Forum\Post;
use App\Models\User;
use App\Models\UsernameChangeHistory;
use Carbon\Carbon;
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
        $continue = $this->confirm('WARNING! This will refresh the cache for forum topics where the username has changed after 2017/08/09');

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
        $this->info('Getting possible last poster counts...');
        $topicIds = Post::withTrashed()
            ->whereIn('poster_id', $ids)
            ->whereNotIn('topic_id', (clone $topicsFirstPoster)->select('topic_id'))
            ->distinct()
            ->select('topic_id') // select is faster than pluck for these.
            ->get();

        $count += $topicIds->count();
        $this->warn("Total {$count}");

        $this->warn((time() - $start).'s to scan.');

        if (!$this->confirm("This will affect an estimated {$count} Topics.")) {
            return $this->error('User aborted!');
        }

        $start = time();

        $bar = $this->output->createProgressBar($count);

        $topicsFirstPoster->chunk(1000, function ($topics) use ($bar) {
            foreach ($topics as $topic) {
                $username = User::select('username')->find($topic->topic_poster)->username;
                if ($topic->topic_first_poster_name !== $username) {
                    $topic->update(['topic_first_poster_name' => $username]);
                }

                $bar->advance();
            }
        });

        $this->warn((time() - $start).'s taken.');

        Topic::withTrashed()->whereIn('topic_id', $topicIds)->chunk(1000, function ($topics) use ($bar) {
            foreach ($topics as $topic) {
                $username = User::select('username')->find($topic->topic_poster)->username;
                if ($topic->topic_first_poster_name !== $username) {
                    $topic->update(['topic_first_poster_name' => $username]);
                }

                $bar->advance();
            }
        });

        $this->warn((time() - $start).'s taken.');

        $bar->finish();
    }
}
