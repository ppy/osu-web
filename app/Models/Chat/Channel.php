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
namespace App\Models\Chat;

use App\Models\User;
use App\Models\Multiplayer\Match;
use App\Interfaces\Messageable;

class Channel extends Model implements Messageable
{
    protected $table = 'channels';
    protected $primaryKey = 'channel_id';
    protected $dates = [
        'creation_time',
    ];
    public $timestamps = false;

    public function messages()
    {
        $this->hasMany(Message::class, 'channel_id', 'channel_id');
    }

    public function allowedGroups()
    {
        return array_map('intval', explode(',', $this->allowed_groups));
    }

    public function canBeMessagedBy(User $user)
    {
        // feels a bit redundant at the moment, but may be useful later for read-only channels, etc
        return $this->canBeReadBy($user);
    }

    public function canBeReadBy(User $user)
    {
        if ($user->isBanned() || $user->isRestricted() || $user->isSilenced()) {
            return false;
        }

        switch (strtolower($this->type)) {
            case 'public':
                return true;
                break;

            case 'private':
                $common_groups = array_intersect(
                    array_pluck($user->userGroups()->get(['group_id'])->toArray(), 'group_id'),
                    $this->allowedGroups()
                );
                return count($common_groups) > 0;
                break;

            case 'spectator':
            case 'multiplayer':
            case 'temporary': // this and the comparisons below are needed until bancho is updated to use the new channel types
                if (substr($this->name, 0, 7) === '#spect_') {
                    return true;
                }
                if (substr($this->name, 0, 4) === '#mp_') {
                    $match_id = intval(str_replace('#mp_', '', $this->name));
                    return in_array($user->user_id, Match::find($match_id)->currentPlayers());
                }
                return false;
                break;

            default:
                return false;
        }
    }

    public function sendMessage(User $sender, $body)
    {
        if (!$this->canBeMessagedBy($sender)) {
            return false;
        }

        $message = new Message();
        $message->user_id = $sender->user_id;
        $message->content = $body;
        $message->channel()->associate($this);
        $message->save();
    }
}
