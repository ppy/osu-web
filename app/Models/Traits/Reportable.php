<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Exceptions\InvariantException;
use App\Models\User;
use App\Models\UserReport;
use App\Notifications\UserReportNotification;

/**
 * @property-read \Illuminate\Database\Eloquent\Collection<UserReport> $reportedIn
 */
trait Reportable
{
    abstract protected function newReportableExtraParams(): array;

    public function reportableAdditionalInfo(): ?string
    {
        return null;
    }

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
        $attributes = $this->newReportableExtraParams();
        $attributes['comments'] = $params['comments'] ?? '';
        $attributes['reporter_id'] = $reporter->getKey();

        if (present($params['reason'] ?? null)) {
            $attributes['reason'] = $params['reason'];
        }

        $existingReport = $this->reportedIn()->where([
            'reporter_id' => $attributes['reporter_id'],
        ])->orderBy('report_id', 'DESC')->first();
        if ($existingReport !== null && $existingReport->isRecent()) {
            throw new InvariantException(osu_trans('errors.user_report.recently_reported'));
        }

        $userReport = $this->reportedIn()->create($attributes);
        $userReport->notify(new UserReportNotification($reporter));

        return $userReport;
    }
}
