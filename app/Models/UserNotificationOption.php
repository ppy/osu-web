<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

    const BEATMAPSET_MODDING = 'beatmapset:modding'; // matches Follow notifiable_type:subtype
    const BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM = Notification::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM;
    const FORUM_TOPIC_REPLY = Notification::FORUM_TOPIC_REPLY;

    const HAS_NOTIFICATION = [self::BEATMAPSET_MODDING, self::FORUM_TOPIC_REPLY];

    protected $casts = [
        'details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setDetailsAttribute($value)
    {
        $details = $this->details ?? [];

        if (!is_array($value)) {
            $value = null;
        }

        if ($this->name === static::BEATMAPSET_DISCUSSION_QUALIFIED_PROBLEM) {
            if (is_array($value['modes'] ?? null)) {
                $modes = array_filter($value['modes'], 'is_string');
                $validModes = array_keys(Beatmap::MODES);

                $details['modes'] = array_values(array_intersect($modes, $validModes));
            }
        }

        if ($this->supportsNotifications()) {
            if (isset($value['mail'])) {
                $details['mail'] = get_bool($value['mail'] ?? null);
            }

            if (isset($value['push'])) {
                $details['push'] = get_bool($value['push'] ?? null);
            }
        }

        if (!empty($details)) {
            $detailsString = json_encode($details);
        }

        $this->attributes['details'] = $detailsString ?? null;
    }

    public function setNameAttribute($value)
    {
        if (!($this->supportsNotifications($value))) {
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

    private function supportsNotifications(?string $name = null)
    {
        return in_array($name ?? $this->name, static::HAS_NOTIFICATION, true);
    }
}
