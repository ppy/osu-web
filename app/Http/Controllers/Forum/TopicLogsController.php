<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Http\Controllers\Forum;

use App\Models\Forum\Topic;
use App\Models\Log;

class TopicLogsController extends Controller
{
    public function __construct()
    {
        return parent::__construct();
    }

    public function show($id)
    {
        if (priv_check('ForumTopicLogsView')->can() === false) {
            abort(403);
        }

        $topic = Topic::withTrashed()->findOrFail($id);

        $logs = $topic->logs()
            ->where('log_type', Log::LOG_FORUM_MOD)
            ->paginate(30);

        return ext_view('forum.topics.logs.show', ['logs' => $logs, 'topic' => $topic]);
    }
}
