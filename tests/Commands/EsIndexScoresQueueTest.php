<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Commands;

use App\Exceptions\InvariantException;
use App\Models\Solo\Score;
use Artisan;
use LaravelRedis;
use Tests\TestCase;

class EsIndexScoresQueueTest extends TestCase
{
    const SCHEMA = 'test_queue_command';

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
     * @dataProvider dataProviderForTestParameterValidity
     */
    public function testParameterValidity(array $params, bool $isValid)
    {
        if (!$isValid) {
            $this->expectException(InvariantException::class);
        }

        $command = $this->artisan('es:index-scores:queue', array_merge($params, ['--schema' => static::SCHEMA]));

        if ($isValid) {
            $command->expectsQuestion('This will queue scores for indexing to schema '.static::SCHEMA.', continue?', 'yes');
        }
    }

    /**
     * @dataProvider dataProviderForTestQueueScores
     */
    public function testQueueScores(callable $setUp, array|callable $params, int $change): void
    {
        $setUp();

        $this->expectCountChange(fn () => static::queueSize(), $change);
        Artisan::call(
            'es:index-scores:queue',
            array_merge(is_callable($params) ? $params() : $params, [
                '--no-interaction' => true,
                '--schema' => static::SCHEMA,
            ]),
        );
    }

    public function dataProviderForTestParameterValidity(): array
    {
        return [
            [[], false],
            [['--all' => true], true],
            [['--from' => 0], true],
            [['--ids' => 0], true],
            [['--ids' => ''], false],
            [['--ids' => ','], false],
            [['--ids' => '1,2'], true],
            [['--ids' => [1,2]], true],
            [['--all' => true, '--from' => 0], false],
            [['--all' => true, '--ids' => 0], false],
            [['--from' => 0, '--ids' => 0], false],
            [['--user' => 0], false],
            [['--user' => 0, '--all' => true], true],
            [['--user' => 0, '--all' => true, '--from' => 0], false],
        ];
    }

    public function dataProviderForTestQueueScores(): array
    {
        $userId = 0;
        $setUp = function () use ($userId) {
            static::clearQueue();
            Score::factory()->count(10)->create();
            $scores = Score::orderBy('id')->get()->all();
            foreach ([$scores[0], $scores[1], $scores[2], $scores[9]] as $score) {
                $score->update(['user_id' => $userId]);
            }
        };

        return [
            [$setUp, ['--all' => true], 10],
            [$setUp, fn (): array => [
                '--ids' => Score::inRandomOrder()->limit(3)->pluck('id')->join(','),
            ], 3],
            [$setUp, fn (): array => ['--from' => Score::max('id') - 1], 1],
            [$setUp, ['--all' => true, '--user' => $userId], 4],
            [$setUp, fn (): array => [
                '--user' => $userId,
                // get id of second last score to cover last two scores
                // but only one is expected to be queued due to user filter
                '--from' => Score::orderBy('id', 'DESC')->limit(2)->get()->all()[1]->getKey() - 1,
            ], 1],
        ];
    }
}
