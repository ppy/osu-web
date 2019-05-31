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
