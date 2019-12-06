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

namespace App\Models\Chat;

use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserRelation;
use DB;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property Channel $channel
 * @property int $channel_id
 * @property bool $hidden
 * @property int|null $last_read_id
 * @property User $user
 * @property User $userScoped
 * @property int $user_id
 */
class UserChannel extends Model
{
    protected $guarded = [];

    protected $primaryKeys = ['user_id', 'channel_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userScoped()
    {
        return $this->belongsTo(User::class, 'user_id')->default();
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    public function markAsRead($message_id = null)
    {
        $maxId = get_int($message_id ?? Message::where('channel_id', $this->channel_id)->max('message_id'));

        // this prevents the read marker from going backwards
        $this->update(['last_read_id' => DB::raw("GREATEST(COALESCE(last_read_id, 0), $maxId)")]);

        $params = [
            'category' => 'channel',
            'object_type' => 'channel',
            'object_id' => $this->channel_id,
        ];
        UserNotification::markAsReadByNotificationIdentifier($this->user, $params);
    }

    public static function presenceForUser(User $user)
    {
        $userId = $user->user_id;

        // retrieve all the channels the user is in and the metadata for each
        $userChannels = self::where('user_channels.user_id', $userId)
            ->where('hidden', false)
            ->join('channels', 'channels.channel_id', '=', 'user_channels.channel_id')
            ->selectRaw('channels.*')
            ->selectRaw('user_channels.last_read_id')
            ->selectRaw('(select max(messages.message_id) from messages where messages.channel_id = user_channels.channel_id) as last_message_id')
            ->get();

        // fetch the users in each of the channels (and whether they're restricted and/or blocked)
        $userRelationTableName = (new UserRelation)->tableName(true);
        $userChannelMembers = self::whereIn('user_channels.channel_id', $userChannels->pluck('channel_id'))
            ->selectRaw('user_channels.*')
            ->selectRaw('phpbb_zebra.foe')
            ->leftJoin($userRelationTableName, function ($join) use ($userRelationTableName, $userId) {
                $join->on("{$userRelationTableName}.zebra_id", 'user_channels.user_id')
                    ->where("{$userRelationTableName}.user_id", $userId);
            })
            ->join('channels', 'channels.channel_id', '=', 'user_channels.channel_id')
            ->where('channels.type', '=', 'PM')
            ->with('userScoped')
            ->get();

        $collection = json_collection(
            $userChannels,
            function ($userChannel) use ($userChannelMembers, $userId) {
                $presence = [
                    'channel_id' => $userChannel->channel_id,
                    'type' => $userChannel->type,
                    'name' => $userChannel->name,
                    'description' => presence($userChannel->description),
                    'last_read_id' => $userChannel->last_read_id,
                    'last_message_id' => $userChannel->last_message_id,
                ];

                if ($userChannel->type !== Channel::TYPES['public']) {
                    // filter out restricted users from the listing
                    $filteredChannelMembers = $userChannelMembers->where('channel_id', $userChannel->channel_id)
                        ->map(function ($userChannel, $key) {
                            return $userChannel->userScoped ? $userChannel->user_id : null;
                        });

                    // TODO: Decided whether we want to return user objects everywhere or just user_ids
                    $filteredChannelMembers = array_values($filteredChannelMembers->toArray());
                    $presence['users'] = $filteredChannelMembers;
                }

                if ($userChannel->type === Channel::TYPES['pm']) {
                    // remove ourselves from $membersArray, leaving only the other party
                    $members = array_diff($filteredChannelMembers, [$userId]);
                    $targetUser = $userChannelMembers->where('user_id', array_shift($members))->first();

                    // hide if target is restricted ($targetUser missing) or is blocked ($targetUser->foe)
                    if (!$targetUser || $targetUser->foe) {
                        return [];
                    }

                    // override channel icon and display name in PMs to always show the other party
                    $userActual = $targetUser->userScoped;
                    $presence['icon'] = $userActual->user_avatar;
                    $presence['name'] = $userActual->username;
                }

                return $presence;
            }
        );

        // strip out the empty [] elements (from restricted/blocked users)
        return array_values(array_filter($collection));
    }

    // Allows save/update/delete to work with composite primary keys.
    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where([
            'user_id' => $this->user_id,
            'channel_id' => $this->channel_id,
        ]);
    }
}
