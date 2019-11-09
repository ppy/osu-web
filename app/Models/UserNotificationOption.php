<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

use App\Traits\Validatable;

/**
 * @property \Carbon\Carbon $created_at
 * @property array|null $details
 * @property string $name
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int $user_id
 */
class UserNotificationOption extends Model
{
    use Validatable;

    const VALID_NAMES = [
        Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM,
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDetailsAttribute($value)
    {
        if ($this->name === Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM) {
            if (is_array($value)) {
                $validModes = array_keys(Beatmap::MODES);

                $modes = array_values(array_intersect($value, $validModes));

                if (count($modes) > 0) {
                    $details = compact('modes');
                }
            }
        }

        $this->attributes['details'] = isset($details) ? json_encode($details) : null;
    }

    public function setNameAttribute($value)
    {
        if (!in_array($value, static::VALID_NAMES, true)) {
            $value = null;
        }

        $this->attributes['name'] = $value;
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if (!present($this->user_id)) {
            $this->validationErrors()->add('user_id', 'required');
        }

        if (!present($this->name)) {
            $this->validationErrors()->add('name', 'required');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        return $this->isValid() && parent::save($options);
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user_notification_option';
    }
}
