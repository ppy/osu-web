<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Models\Chat;

use App\Models\Chat\Channel;
use App\Models\Chat\Message;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class MessageTest extends TestCase
{
    public static function dataProviderForTestFilterOldMessage(): array
    {
        return [
            ['public', true],
            ['team', false],
        ];
    }

    public static function dataProviderForTestIsUserCommand(): array
    {
        return [
            ['! report', false],
            ['!!', false],
            ['!', false],
            ['!mp 1', true],
            ['!report', true],
            ['hello', false],
        ];
    }

    public function testFilterCurrentMessage(): void
    {
        $channel = Channel::factory()->make(['type' => Channel::TYPES['public']]);
        $message = Message::factory()->make([
            'timestamp' => Carbon::now(),
        ]);

        $this->assertSame(1, count(Message::filter([$message], $channel, null)));
    }

    #[DataProvider('dataProviderForTestFilterOldMessage')]
    public function testFilterOldMessage(string $type, bool $isRemoved): void
    {
        $channel = Channel::factory()->make(['type' => Channel::TYPES[$type]]);
        $message = Message::factory()->make([
            'timestamp' => Carbon::now()->subHours($GLOBALS['cfg']['osu']['chat']['public_backlog_limit'] + 1),
        ]);

        $this->assertSame($isRemoved ? 0 : 1, count(Message::filter([$message], $channel, null)));
    }

    public function testFilterUserCommand(): void
    {
        $userId = 1;
        $channel = Channel::factory()->make(['type' => Channel::TYPES['public']]);
        $messageCommand = Message::factory()->make([
            'content' => '!report what',
            'timestamp' => Carbon::now(),
            'user_id' => $userId,
        ]);
        $messageNormal = Message::factory()->make([
            'content' => '!!',
            'timestamp' => Carbon::now(),
            'user_id' => $userId,
        ]);
        $messages = [$messageCommand, $messageNormal];

        $filterOwn = Message::filter($messages, $channel, $userId);
        $this->assertSame(2, count($filterOwn));

        $filterOther = Message::filter($messages, $channel, $userId + 1);
        $this->assertSame(1, count($filterOther));
        $this->assertSame($messageNormal, $filterOther[0]);
    }

    #[DataProvider('dataProviderForTestIsUserCommand')]
    public function testIsUserCommand(string $content, bool $result): void
    {
        $this->assertSame($result, new Message(compact('content'))->isUserCommand());
    }
}
