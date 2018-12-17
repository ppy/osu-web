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

use App\Models\Beatmap;
use App\Models\User;
use App\Models\Score\Model as Score;

class ReportScore
{
    protected $reporter;
    protected $score;
    protected $mode;
    protected $comments;
    protected $reason = 'Cheating';

    public function __construct(User $reporter, Score $score, $mode, array $params)
    {
        $this->reporter = $reporter;
        $this->score = $score;
        $this->mode = Beatmap::modeInt($mode);
        $this->comments = presence($params['comments'] ?? null);
    }

    public function report()
    {
        try {
            $report = $this->reporter->reportsMade()->create([
                'user_id' => $this->score->user_id,
                'mode' => $this->mode,
                'comments' => $this->comments,
                'reason' => $this->reason,
                'reportable_type' => 'score',
                'reportable_id' => $this->score->score_id,
            ]);
        } catch (PDOException $ex) {
            // ignore duplicate reports;
            if (!is_sql_unique_exception($ex)) {
                throw $ex;
            }
        }
    }
}
