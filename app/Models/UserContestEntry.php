<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        $entry = new static();

        DB::transaction(function () use ($entry, $file, $user, $contest) {
            $entry->save(); // get id

            $entry->filesize = $file->getSize();
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
