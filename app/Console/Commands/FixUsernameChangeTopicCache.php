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
            $this->error('User aborted!');

            return;
        }

        $ids = UsernameChangeHistory::where('timestamp', '>', Carbon::parse('2017/08/09'))
            ->distinct()
            ->pluck('user_id');

        $topics = Topic::whereIn('topic_last_poster_id', $ids);
        $bar = $this->output->createProgressBar($topics->count());
        Topic::whereIn('topic_last_poster_id', $ids)->chunk(1000, function ($topics) use ($bar) {
            foreach ($topics as $topic) {
                $topic->refreshCache();
                $bar->advance();
            }
        });

        $bar->finish();
    }
}
