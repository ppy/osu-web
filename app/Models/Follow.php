<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

namespace App\Models;

use App\Libraries\MorphMap;
use App\Traits\Validatable;

/**
 * @property int $id
 * @property int $user_id
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $subtype
 */
class Follow extends Model
{
    use Validatable;

    public function scopeWhereNotifiable($query, $notifiable)
    {
        $query->where([
            'notifiable_type' => $notifiable->getMorphClass(),
            'notifiable_id' => $notifiable->getKey(),
        ]);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function setNotifiableAttribute($value)
    {
        $this->notifiable()->associate($value);
    }

    public function setNotifiableTypeAttribute($value)
    {
        if (MorphMap::getClass($value) === null) {
            return;
        }

        $this->attributes['notifiable_type'] = $value;
    }

    public function setUserAttribute($value)
    {
        $this->user()->associate($value);
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'follow';
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        if ($this->notifiable === null) {
            $this->validationErrors()->add('notifiable', 'required');
        }

        if ($this->subtype === 'comment' && !in_array($this->notifiable_type, Comment::COMMENTABLES, true)) {
            $this->validationErrors()->add('notifiable_type', '.invalid');
        }

        // FIXME: this should accept other types later.
        if ($this->subtype !== 'comment') {
            $this->validationErrors()->add('subtype', '.invalid');
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        return $this->isValid() && parent::save($options);
    }
}
