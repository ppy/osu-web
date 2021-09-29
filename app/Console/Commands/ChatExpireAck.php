<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Chat\Channel;
use Illuminate\Console\Command;
use LaravelRedis as Redis;

class ChatExpireAck extends Command
{
    protected $signature = 'chat:expire-ack';

    protected $description = 'Cleans up expired chat keep alives.';

    public function handle()
    {
        $max = now()->subSeconds(Channel::CHAT_ACTIVITY_TIMEOUT)->timestamp;
        $this->line("Removing users inactive before {$max}");
        $progress = $this->output->createProgressBar();

        Channel::public()->chunkById(100, function ($chunk) use ($max, $progress) {
            foreach ($chunk as $channel) {
                Redis::zremrangebyscore("chat:channel:{$channel->getKey()}", 0, $max);
                $progress->advance();
            }
        });

        $progress->finish();
        $this->line('');
    }
}
