<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace App\Models\Store;

/**
 * @property int $id
 * @property string|null $account_id
 * @property string|null $email
 */
class PaypalBanned extends Model
{
    public $timestamps = false;
}
