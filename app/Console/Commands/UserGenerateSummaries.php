<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\UserMonthlyPlaycount;
use App\Models\UserSummary;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class UserGenerateSummaries extends Command
{
    private const QUEUE_KEY = 'user_generate_summaries';
    private const YEAR = 2025;

    protected $signature = 'user:generate-summaries {--task=}';

    protected $description = 'Synchronises forum post counts for all users.';

    public function handle()
    {
        return match ($this->option('task')) {
            'monitor' => $this->handleMonitor(),
            'process' => $this->handleProcess(),
            'queue' => $this->handleQueue(),
        };
    }

    private function handleMonitor()
    {
        static $speedWait = 10;

        $n = 0;
        while (($len = \LaravelRedis::llen(static::QUEUE_KEY)) !== 0) {
            if ($len !== false) {
                if (!isset($progress)) {
                    $progress = $this->output->createProgressBar($len);
                    $progress->setFormat('%len% [%bar%] %message%');
                    $progress->setMessage('0/s');
                    $total = $len;
                    $prevLen = $len;
                }
                if ($n >= $speedWait) {
                    $n = 0;
                    $speed = i18n_number_format(($prevLen - $len) / $speedWait);
                    $progress->setMessage("{$speed}/s");
                    $prevLen = $len;
                } else {
                    $n++;
                }
                $progress->setMessage(i18n_number_format($len), 'len');
                $progress->setProgress($total - $len);
            }
            sleep(1);
        }
    }

    private function handleProcess()
    {
        while (($userId = \LaravelRedis::lpop(static::QUEUE_KEY)) !== false) {
            $this->info("Generating summary for user id: {$userId}");
            UserSummary::createForUser(static::YEAR, (int) $userId);
        }
    }

    private function handleQueue()
    {
        if (\LaravelRedis::exists(static::QUEUE_KEY) === 0) {
            $this->info('Generating user list: getting user ids');
            $startTime = CarbonImmutable::now()->setYear(static::YEAR)->startOfYear();
            $timeRange = array_map(
                fn ($t) => $t->format('ym'),
                [$startTime, $startTime->endOfYear()],
            );
            $userIds = UserMonthlyPlaycount
                ::distinct('user_id')
                ->whereBetween('year_month', $timeRange)
                ->pluck('user_id');
            $this->info('Generating user list: queuing to redis');
            foreach ($userIds->chunk(1000) as $chunkedUserIds) {
                \LaravelRedis::rpush(static::QUEUE_KEY, ...$chunkedUserIds);
            }
        } else {
            $this->info('User list already exists');
        }

        $this->info('Requeuing unprocessed summaries');
        $unprocessedUserIds = UserSummary::where('year', static::YEAR)->where('processed', false)->pluck('user_id');
        if (count($unprocessedUserIds) > 0) {
            \LaravelRedis::rpush(static::QUEUE_KEY, ...$unprocessedUserIds);
        }

        $this->info('Done');
    }
}
