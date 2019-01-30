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

namespace App\Models;

use App\Traits\Uploadable;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

/**
 * @property Contest $contest
 * @property int|null $contest_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $ext
 * @property int|null $filesize
 * @property string|null $hash
 * @property int $id
 * @property string|null $original_filename
 * @property \Carbon\Carbon|null $updated_at
 * @property User $user
 * @property int|null $user_id
 */
class UserContestEntry extends Model
{
    use SoftDeletes;
    use Uploadable;

    protected $dates = ['deleted_at'];

    public function getFileRoot()
    {
        return 'user-contest-entries';
    }

    public static function upload(UploadedFile $file, $user, $contest = null)
    {
        $entry = new static;

        DB::transaction(function () use ($entry, $file, $user, $contest) {
            $entry->save(); // get id

            $entry->filesize = $file->getClientSize();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->user()->associate($user);
            $entry->contest()->associate($contest);
            $entry->storeFile($file->getRealPath(), $file->getClientOriginalExtension());
            $entry->save();
        });

        return $entry;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
