<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Libraries;

use App\Exceptions\ModelNotSavedException;
use App\Models\User;

class ReportUser
{
    protected $reporter;
    protected $user;
    protected $comments;
    protected $reason;

    public function __construct(User $reporter, User $user, array $params)
    {
        $this->reporter = $reporter;
        $this->user = $user;
        $this->comments = presence($params['comments'] ?? null);
        $this->reason = presence($params['reason'] ?? null);
    }

    public function report()
    {
        try {
            $report = $this->reporter->reportsMade()->create([
                'user_id' => $this->user->getKey(),
                'comments' => $this->comments,
                'reason' => $this->reason,
                'reportable_type' => 'user',
                'reportable_id' => $this->user->getKey(),
            ]);
        } catch (PDOException $ex) {
            // ignore duplicate reports;
            if (!is_sql_unique_exception($ex)) {
                throw $ex;
            }
        }
    }
}
