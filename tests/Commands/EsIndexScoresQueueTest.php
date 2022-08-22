<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Models\Solo\Score;
use Artisan;
use LaravelRedis;
use Tests\TestCase;

class EsIndexScoresQueueTest extends TestCase
{
    const SCHEMA = 'test_queue_command';
    const TARGETED_USER_ID = 0;

    private static function clearQueue(): void
    {
        LaravelRedis::del(static::queueKey());
    }

    private static function queueKey(): string
    {
        return 'osu-queue:score-index-'.static::SCHEMA;
    }

    private static function queueSize(): int
    {
        return LaravelRedis::llen(static::queueKey());
    }

    /**
     * @dataProvider dataProviderForTestQueueScores
     */
    public function testQueueScores(array|callable $params, int $change): void
    {
        static::clearQueue();
        Score::factory()->count(10)->create();
        Score::limit(5)->update(['user_id' => static::TARGETED_USER_ID]);
        $this->expectCountChange(fn () => static::queueSize(), $change);
        Artisan::call(
            'es:index-scores:queue',
            array_merge(is_callable($params) ? $params() : $params, [
                '--no-interaction' => true,
                '--schema' => static::SCHEMA,
            ]),
        );
    }

    public function dataProviderForTestQueueScores(): array
    {
        return [
            [['--all' => true], 10],
            [['--all' => true, '--user' => static::TARGETED_USER_ID], 5],
            [function (): array {
                $ids = Score::inRandomOrder()->limit(3)->pluck('id')->all();

                return ['--ids' => implode(',', $ids)];
            }, 3],
            [fn (): array => ['--from' => Score::max('id') - 1], 1],
        ];
    }
}
