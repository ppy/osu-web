<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Models\User;
use App\Models\UserReport;
use App\Notifications\UserReportNotification;
use PDOException;

trait Reportable
{
    abstract protected function newReportableExtraParams(): array;

    public function reportedIn()
    {
        return $this->morphMany(UserReport::class, 'reportable');
    }

    /**
     * Creates and saves a new UserReport.
     *
     * @param User $reporter
     * @param array $params
     * @return UserReport|null The instance of UserReport saved, null if it is a duplicate.
     */
    public function reportBy(User $reporter, array $params = []): ?UserReport
    {
        try {
            $attributes = $this->newReportableExtraParams();
            $attributes['comments'] = $params['comments'] ?? '';
            $attributes['reporter_id'] = $reporter->getKey();

            if (array_key_exists('reason', $params)) {
                $attributes['reason'] = $params['reason'];
            }

            $userReport = $this->reportedIn()->create($attributes);
            $userReport->notify(new UserReportNotification($reporter));

            return $userReport;
        } catch (PDOException $e) {
            // ignore duplicate reports
            if (!is_sql_unique_exception($e)) {
                throw $e;
            }

            return null;
        }
    }
}
