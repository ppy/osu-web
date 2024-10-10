<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models\Forum;

/**
 * Icons used to label various models from phpBB. On the old website, they were
 * available for use, but now they are read-only.
 *
 * @property bool $display_on_posting
 * @property int $icons_height
 * @property int $icons_id
 * @property int $icons_order
 * @property string $icons_url
 * @property int $icons_width
 */
class LegacyIcon extends Model
{
    public $timestamps = false;

    protected $casts = ['display_on_posting' => 'boolean'];
    protected $primaryKey = 'icons_id';
    protected $table = 'phpbb_icons';
}
