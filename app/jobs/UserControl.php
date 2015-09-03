<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */
class UserControl
{
    // the reason for putting this in a queue is that
    // we can delay firing this for as long as we like.
    public function ban($job, $data)
    {
        $id = @$data['id'];
        $user = User::find($id);
        $reason = @$data['reason'] ?: 'no reason';
        $length = (int) @$data['length'];

        if ($user) {
            DB::statement('call user_ban(?)', [$user->user_id]);
        } else {
            sentry_log("failed to ban a user ($id; job: {$job->getJobId()})", 'queue', Raven_Client::FATAL);
        }

        $job->delete();
    }

    public function rename($job, $data)
    {
        $force = @$data['force'];
        $id = @$data['id'];
        $username = $data['username'];

        $user = User::find($id);

        if ($user) {
            $user->username_previous = $user->username;
            $user->username = $username;
            $user->username_clean = preg_replace('/[^a-z0-9]/', '_', strtolower($username));
            $user->save();

            DB::statement('call user_rename(?)', [$user->user_id]);
        } else {
            sentry_log("failed to rename a user ($id; job: {$job->getJobId()}; to: $username)", 'queue', Raven_Client::FATAL);
        }

        $job->delete();
    }
}
