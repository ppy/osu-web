<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Docs\Attributes\Sort;
use App\Models\Event;

/**
 * @group Events
 */
class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('require-scopes:public', ['only' => ['index']]);

        parent::__construct();
    }

    /**
     * Get Events
     *
     * Returns a collection of [Event](#event)s in order of creation time.
     *
     * ---
     *
     * ### Response Format
     *
     * Field         | Type
     * ------------- | ----
     * cursor_string | [CursorString](#cursorstring)
     * events        | [Event](#event)[]
     *
     * @usesCursor
     *
     * @response {
     *   events: [
     *     {
     *       created_at: "2022-12-08T02:02:51+00:00",
     *       id: 57,
     *       type: "achievement",
     *       achievement: { ... },
     *       user: { ... }
     *     },
     *     ...
     *   ],
     *   cursor_string: "eyJldmVudF9pZCI6OH0"
     * }
     */
    #[Sort('IdSort')]
    public function index()
    {
        $params = request()->all();
        $cursorHelper = Event::makeDbCursorHelper(get_string($params['sort'] ?? null));

        [$events, $hasMore] = Event
            ::cursorSort($cursorHelper, cursor_from_params($params))
            ->limit(50)
            ->getWithHasMore();

        return [
            'events' => json_collection($events, 'Event'),
            ...cursor_for_response($cursorHelper->next($events, $hasMore)),
        ];
    }
}
