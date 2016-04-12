<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\AuthorizationException;

class BeatmapDiscussionPost extends Model
{
    protected $guarded = [];

    protected $touches = ['beatmapDiscussion'];

    protected $casts = [
        'id' => 'integer',
        'beatmap_discussion_id' => 'integer',
        'user_id' => 'integer',
        'last_editor_id' => 'integer',
    ];

    public function beatmapDiscussion()
    {
        return $this->belongsTo(BeatmapDiscussion::class);
    }

    public function beatmapsetDiscussion()
    {
        return $this->beatmapDiscussion->beatmapsetDiscussion();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasValidMessage()
    {
        return present($this->message);
    }

    /*
     * Called before saving. Callback definition in
     * App\Providers\AppServiceProviders.
     */
    public function isValid()
    {
        return $this->hasValidMessage();
    }

    public function authorizeUpdate($user)
    {
        if ($user === null) {
            throw new AuthorizationException(trans('beatmap_discussions.update.null_user'));
        }

        if ($user->isAdmin()) {
            return;
        }

        if ($user->user_id !== $this->user_id) {
            throw new AuthorizationException(trans('beatmap_discussions.update.wrong_user'));
        }
    }
}
