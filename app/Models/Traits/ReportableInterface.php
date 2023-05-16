<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Traits;

use App\Models\User;
use App\Models\UserReport;

interface ReportableInterface
{
    public function reportableAdditionalInfo(): ?string;
    public function reportBy(User $reporter, array $params): ?UserReport;
    public function trashed();
}
