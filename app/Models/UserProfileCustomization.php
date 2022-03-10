<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Models;

use App\Casts\UserPreferences;
use App\Libraries\ProfileCover;
use App\Traits\Validatable;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

/**
 * @property array|null $cover_json
 * @property \Carbon\Carbon $created_at
 * @property string|null $extras_order
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 * @property int|null $user_id
 */
class UserProfileCustomization extends Model
{
    use Validatable;

    /**
     * An array of all possible profile sections, also in their default order.
     */
    const SECTIONS = [
        'me',
        'recent_activity',
        'top_ranks',
        'medals',
        'historical',
        'beatmaps',
        'kudosu',
    ];

    private $cover;

    public function __construct(array $attributes = [])
    {
        static $casts;
        $casts ??= static::modelCasts();
        $this->casts = $casts;

        parent::__construct($attributes);
    }

    public static function repairExtrasOrder($value)
    {
        // read from inside out
        return array_values(
            // remove duplicate sections from previous merge
            array_unique(
                // ensure all sections are included
                array_merge(
                    // remove invalid sections
                    array_intersect($value, static::SECTIONS),
                    static::SECTIONS
                )
            )
        );
    }

    private static function modelCasts(): array
    {
        $ret = [
            'cover_json' => 'array',
            'options' => AsArrayObject::class,
        ];
        $class = UserPreferences::class;
        foreach (UserPreferences::attributes() as $field => $_attr) {
            $ret[$field] = $class;
        }

        return $ret;
    }

    public function cover()
    {
        if ($this->cover === null) {
            $this->cover = new ProfileCover($this->user_id, $this->cover_json);
        }

        return $this->cover;
    }

    public function setCover($id, $file)
    {
        $this->cover_json = $this->cover()->set($id, $file);

        $this->save();
    }


    public function getExtrasOrderAttribute($value)
    {
        $newValue = $this->options['extras_order'] ?? null;

        if ($newValue === null && $value !== null) {
            $newValue = json_decode($value, true);
        }

        if ($newValue === null) {
            return static::SECTIONS;
        }

        return static::repairExtrasOrder($newValue, true);
    }

    public function setExtrasOrderAttribute($value)
    {
        $this->attributes['extras_order'] = null;
        $this->options ??= [];
        $this->options['extras_order'] = static::repairExtrasOrder($value);
    }

    public function isValid()
    {
        $this->validationErrors()->reset();

        foreach (UserPreferences::attributes() as $field => $attr) {
            if (isset($attr['validator']) && !$attr['validator']($this->$field)) {
                $this->validationErrors()->add($field, 'invalid');
            }
        }

        return $this->validationErrors()->isEmpty();
    }

    public function save(array $options = [])
    {
        if (!($options['skipValidations'] ?? false) && !$this->isValid()) {
            return false;
        }

        return parent::save($options);
    }

    public function validationErrorsTranslationPrefix()
    {
        return 'user_profile_customization';
    }
}
