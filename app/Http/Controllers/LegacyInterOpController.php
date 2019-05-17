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

namespace App\Http\Controllers;

use App\Jobs\RegenerateBeatmapsetCover;
use App\Libraries\Session\Store as SessionStore;
use App\Libraries\UserBestScoresCheck;
use App\Models\Achievement;
use App\Models\Beatmap;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\NewsPost;
use App\Models\Notification;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;

class LegacyInterOpController extends Controller
{
    use DispatchesJobs;

    public function regenerateBeatmapsetCovers($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        $job = (new RegenerateBeatmapsetCover($beatmapset))->onQueue('beatmap_default');
        $this->dispatch($job);

        return ['success' => true];
    }

    public function news()
    {
        $newsPosts = NewsPost::default()->limit(5)->get();
        $posts = [];

        foreach ($newsPosts as $post) {
            $posts[] = [
                  'timestamp' => $post->published_at->timestamp,
                  'permalink' => route('news.show', $post->slug),
                  'title' => $post->title(),
                  'body' => $post->previewText(),
            ];
        }

        return $posts;
    }

    public function refreshBeatmapsetCache($id)
    {
        Beatmapset::findOrFail($id)->refreshCache();

        return ['success' => true];
    }

    public function userAchievement($id, $achievementId, $beatmapId = null)
    {
        $user = User::findOrFail($id);
        $achievement = Achievement::findOrFail($achievementId);

        try {
            $userAchievement = $user->userAchievements()->create([
                'achievement_id' => $achievement->getKey(),
                'beatmap_id' => $beatmapId,
            ]);
        } catch (Exception $e) {
            if (is_sql_unique_exception($e)) {
                return error_popup('user already unlocked the specified achievement');
            }

            throw $e;
        }

        Event::generate('achievement', compact('achievement', 'user'));
        broadcast_notification(Notification::USER_ACHIEVEMENT_UNLOCK, $achievement, $user);
    }

    public function userBestScoresCheck($id)
    {
        $user = User::findOrFail($id);

        foreach (Beatmap::MODES as $mode => $_v) {
            (new UserBestScoresCheck($user))->run($mode);
        }

        return ['success' => true];
    }

    public function userSessionsDestroy($id)
    {
        SessionStore::destroy($id);

        return ['success' => true];
    }
}
