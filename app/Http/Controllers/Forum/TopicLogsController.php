<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Topic;
use App\Models\Log;

class TopicLogsController extends Controller
{
    public function index($topicId)
    {
        $topic = Topic::withTrashed()->findOrFail($topicId);

        priv_check('ForumModerate', $topic->forum)->ensureCan();

        $logs = $topic->logs()
            ->where('log_type', Log::LOG_FORUM_MOD)
            ->orderByDesc('log_time')
            ->paginate(30);

        return ext_view('forum.topics.logs.index', compact('logs', 'topic'));
    }
}
