<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Chat\UserChannel;
use DB;
use Illuminate\Console\Command;

class FixMissingUserChannels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:missing-userchannels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recreates UserChannels that were deleted.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = $this->confirm('Proceed?');

        if (!$continue) {
            $this->error('Aborted.');
            return;
        }

        $start = time();

        $this->info('Getting a list of channels that need fixing...');

        $channels =
            DB::connection('mysql-chat')
                ->table('channels')
                ->select(
                    'channels.channel_id',
                    'channels.name',
                    DB::raw('(SELECT count(*) FROM user_channels WHERE user_channels.channel_id = channels.channel_id) AS user_count')
                )
                ->where('channels.type', 'PM')
                ->having('user_count', '<', 2)
                ->get();

        $count = count($channels);
        $this->warn("Total {$count}");
        $this->warn((time() - $start).'s to scan.');

        // reconfirm
        if (!$this->confirm("{$count} channels need to be repaired, proceed?")) {
            $this->error('Aborted.');
            return;
        }

        $start = time();
        $bar = $this->output->createProgressBar($count);

        foreach ($channels as $channel) {
            $userIds = explode('-', str_replace('#pm_', '', $channel->name));
            foreach ($userIds as $userId) {
                $userChannel = UserChannel::where([
                    'channel_id' => $channel->channel_id,
                    'user_id' => $userId,
                ]);

                if (!$userChannel->exists()) {
                    $userChannel = new UserChannel();
                    $userChannel->channel_id = $channel->channel_id;
                    $userChannel->user_id = $userId;
                    $userChannel->hidden = true;
                    $userChannel->save();
                }
            }

            $bar->advance();
        }

        $this->warn("\n".(time() - $start).'s taken.');
        $bar->finish();
    }
}
