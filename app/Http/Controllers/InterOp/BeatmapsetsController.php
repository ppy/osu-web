<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\InterOp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Jobs\BeatmapsetDelete;
use App\Jobs\Notifications\UserBeatmapsetNew;
use App\Jobs\Notifications\UserBeatmapsetRevive;
use App\Models\BeatmapDiscussion;
use App\Models\BeatmapDiscussionPost;
use App\Models\Beatmapset;
use App\Models\Event;
use App\Models\User;

class BeatmapsetsController extends Controller
{
    public function broadcastNew($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        (new UserBeatmapsetNew($beatmapset))->dispatch();

        if (api_version() >= 20241213)
            Event::generate('beatmapsetUpload', ['beatmapset' => $beatmapset]);

        return response(null, 204);
    }

    public function broadcastRevive($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);

        (new UserBeatmapsetRevive($beatmapset))->dispatch();

        if (api_version() >= 20241213)
            Event::generate('beatmapsetRevive', ['beatmapset' => $beatmapset]);

        return response(null, 204);
    }

    public function broadcastUpdate($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);
        $user = User::findOrFail(request()->integer('user_id'));

        Event::generate('beatmapsetUpdate', ['beatmapset' => $beatmapset, 'user' => $user]);

        return response(null, 204);
    }

    public function destroy($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);
        $user = User::findOrFail($GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id']);

        (new BeatmapsetDelete($beatmapset, $user))->handle();

        return response(null, 204);
    }

    public function disqualify($id)
    {
        $beatmapset = Beatmapset::findOrFail($id);
        $user = User::findOrFail($GLOBALS['cfg']['osu']['legacy']['bancho_bot_user_id']);

        $message = request('message') ?? null;

        $discussion = new BeatmapDiscussion([
            'beatmapset_id' => $beatmapset->getKey(),
            'message_type' => 'problem',
            'user_id' => $user->getKey(),
            'resolved' => false,
        ]);

        $post = new BeatmapDiscussionPost([
            'message' => $message,
            'user_id' => $user->getKey(),
        ]);

        $discussion->getConnection()->transaction(function () use ($discussion, $post, $user) {
            $discussion->saveOrExplode();
            $post->beatmap_discussion_id = $discussion->getKey();
            $post->saveOrExplode();

            $discussion->beatmapset->disqualifyOrResetNominations($user, $discussion);
        });

        return ['beatmapset_discussion_id' => $discussion->getKey()];
    }
}
