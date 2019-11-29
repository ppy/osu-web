<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DisqusImport::class,

        Commands\EsCreateSearchBlacklist::class,
        Commands\EsIndexDocuments::class,
        Commands\EsIndexWiki::class,

        // modding stuff
        Commands\ModdingQueueUpdateCommand::class,
        Commands\ModdingRankCommand::class,
        Commands\ModdingScoreIndexCommand::class,

        Commands\UserForumStatSyncCommand::class,
        Commands\BeatmapsetsHypeSyncCommand::class,

        Commands\StoreCleanupStaleOrders::class,
        Commands\StoreExpireProducts::class,

        // builds
        Commands\BuildsCreate::class,
        Commands\BuildsUpdatePropagationHistory::class,

        // leaderboard recalculation
        Commands\RankingsRecalculateCountryStats::class,

        // moddingv2 kudosu recalculation
        Commands\KudosuRecalculateDiscussionsGrants::class,

        // fix username change fail :D
        Commands\FixUsernameChangeTopicCache::class,

        // fix userchannel deletion fail
        Commands\FixMissingUserChannels::class,

        // fix forum display order
        Commands\FixForumDisplayOrder::class,

        Commands\MigrateFreshAllCommand::class,

        Commands\OAuthDeleteExpiredTokens::class,

        Commands\UserBestScoresCheckCommand::class,
        Commands\UserRecalculateRankCounts::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('store:cleanup-stale-orders')
            ->daily();

        $schedule->command('store:expire-products')
            ->hourly();

        $schedule->command('builds:update-propagation-history')
            ->everyThirtyMinutes();

        $schedule->command('rankings:recalculate-country')
            ->cron('25 0,3,6,9,12,15,18,21 * * *');

        $schedule->command('modding:rank')
            ->cron('*/20 * * * *');

        $schedule->command('oauth:delete-expired-tokens')
            ->cron('14 1 * * *');
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
