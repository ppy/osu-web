<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Console\Commands;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use Illuminate\Console\Command;

class ChatChannelSetLastMessageId extends Command
{
    const MAX_PER_LOOP = 1000;
    const NOTIFICATION_ID_BUFFER = 1000;

    protected $signature = 'chat:channel-set-last-message-id {--chunk-size=1000} {--delay=1}';

    protected $description = 'Updates channels where last_message_id is not set.';

    public function handle()
    {
        $delay = $this->getOptionValue('delay', 1);
        $chunkSize = $this->getOptionValue('chunk-size', 1000);
        if ($chunkSize < 1) {
            return;
        }

        $this->line("Updating chat channels without last_message_id with {$delay}s delay between chunks of {$chunkSize}...");

        $query = Channel::where('last_message_id', null);
        $progress = $this->output->createProgressBar($query->count());
        $query->chunkById($chunkSize, function ($chunk) use ($delay, $progress) {
            foreach ($chunk as $channel) {
                $lastMessageId = optional(Message::where('channel_id', $channel->getKey())->last())->getKey();
                if ($lastMessageId !== null) {
                    $channel->update(['last_message_id' => $lastMessageId]);
                }

                $progress->advance();
            }

            sleep($delay);
        });

        $progress->finish();
    }

    private function getOptionValue(string $name, int $default)
    {
        $value = $this->option($name);
        if (!ctype_digit($value)) {
            $value = $default;
        }

        return get_int($value);
    }
}
