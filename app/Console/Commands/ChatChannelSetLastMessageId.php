<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Chat\Channel;
use Illuminate\Console\Command;

class ChatChannelSetLastMessageId extends Command
{
    protected $signature = 'chat:channel-set-last-message-id {--chunk-size=1000} {--delay=1}';

    protected $description = 'Updates channels where last_message_id is not set.';

    public function handle()
    {
        $delay = $this->option('delay') ?? 1;
        $chunkSize = $this->option('chunk-size') ?? 1000;
        if ($chunkSize < 1) {
            return;
        }

        $this->line("Updating chat channels without last_message_id with {$delay}s delay between chunks of {$chunkSize}...");

        $progress = $this->output->createProgressBar();
        $max = Channel::max('channel_id');
        Channel::where('last_message_id', null)->where('channel_id', '<=', $max)->chunkById($chunkSize, function ($chunk) use ($delay, $progress) {
            foreach ($chunk as $channel) {
                $lastMessageId = $channel->messages()->max('message_id');
                if ($lastMessageId !== null) {
                    $channel->update(['last_message_id' => $lastMessageId]);
                }

                $progress->advance();
            }

            sleep($delay);
        });

        $progress->finish();
        $this->line('');
    }
}
