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

use App\Models\User;
use App\Models\UserReport;
use App\Models\Reportable;
use PDOException;

abstract class ReportBase
{
    /** @var string */
    protected $comments;
    /** @var int */
    protected $modeInt = 0;
    /** @var string */
    protected $reason;
    /** @var Reportable */
    protected $reportable;
    /** @var User */
    protected $reporter;

    public function __construct(User $reporter, Reportable $reportable)
    {
        priv_check('MakeReport')->ensureCan();

        $this->reporter = $reporter;
        $this->reportable = $reportable;
    }

    public function report() : UserReport
    {
        try {
            $report = $this->reporter->reportsMade()->create([
                'comments' => $this->comments,
                'mode' => $this->modeInt,
                'reason' => $this->reason,
                'reportable_type' => $this->reportable->getReportableType(),
                'reportable_id' => $this->reportable->getKey(),
                'user_id' => $this->reportable->getReportableUserId(),
            ]);

            return $report;
        } catch (PDOException $ex) {
            // ignore duplicate reports;
            if (!is_sql_unique_exception($ex)) {
                throw $ex;
            }
        }
    }
}
