<?php

/**
 *    Copyright 2015 ppy Pty. Ltd.
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

class Mod extends Eloquent
{
    protected $table = 'osu_modding.items';
    protected $primaryKey = 'item_id';
    protected $softDelete = true;
    protected $fillable = ['user_id', 'is_resolved', 'type', 'text', 'beatmap_id', 'beatmapset_id', 'time', 'parent_item_id'];
    protected $hidden = ['last_edit', 'edit_count', 'session_id', 'user_id', 'parent_item_id', 'score'];
    protected $icons = [
        'resolved' => 'fa-check-circle-o resolved',
        'praise' => 'fa-heart praise',
        'suggestion' => 'fa-circle-o suggestion',
        'problem' => 'fa-exclamation-circle problem',
        'nomination' => 'fa-plus-square resolved',
    ];

    const PRAISE = 'praise';
    const PROBLEM = 'problem';
    const SUGGESTION = 'suggestion';
    const NOMINATION = 'nomination';
    const MIN_LENGTH = 15;
    const MAX_LENGTH = 800;

    public static function validateMap($set, $beatmap)
    {
        try {
            $set = BeatmapSet::findOrFail($set);
        } catch (Exception $e) {
            return false;
        }

        if (!$beatmap) {
            return true;
        }

        $beatmaps = $set->beatmaps->toArray();
        $ids = array_column($beatmaps, 'beatmap_id');

        if (in_array($beatmap, $ids)) {
            return $beatmap;
        }

        if ($beatmap == 'first') {
            return $ids[0];
        }

        if ($beatmap == 'general' or $beatmap == 'nomination') {
            return;
        }

        return false;
    }

    public static function validateComment($comment)
    {
        return is_string($comment) and (strlen($comment) > self::MIN_LENGTH and strlen($comment) < self::MAX_LENGTH);
    }

    public static function insert($id, $type)
    {

        // verify that a beatmap is part of a set (if missing, )
        $beatmap = static::validateMap($id, Input::get('beatmap'));
        $comment = static::validateComment(Input::get('comment'));

        if ($beatmap !== false) {
            if ($comment) {
                $mod = [
                    'user_id' => Auth::user()->user_id,
                    'type' => $type,
                    'text' => Input::get('comment'),
                    'beatmap_id' => $beatmap,
                    'beatmapset_id' => $id,
                    'time' => Input::get('time') ?: null,
                    'is_resolved' => 0,
                ];

                $mod = new static($mod);

                $status = $mod->save();

                if ($status) {
                    return Response::json(['success' => trans('beatmaps.modding.success.comment')]);
                }
            } else {
                return Response::json(['error' => trans('beatmaps.modding.errors.invalid')]);
            }
        } else {
            return Response::json(['error' => trans('beatmaps.modding.errors.beatmap')]);
        }
    }

    // one post has one user

    public function creator()
    {
        return $this->belongsTo('User', 'user_id', 'user_id');
    }

    // one post has one parent

    public function parent()
    {
        return $this->belongsTo('Mod', 'item_id', 'parent_item_id');
    }

    // one parent has many children

    public function children()
    {
        return $this->hasMany('Mod', 'item_id', 'parent_item_id');
    }

    // one post has one reply

    public function reply()
    {
        return $this->hasOne('Mod', 'reply_to', 'item_id');
    }

    public function scopeNominations($query)
    {
        return $query->where('item_type', '=', self::NOMINATION);
    }

    public function scopeProblems($query)
    {
        return $query->where('item_type', '=', self::PROBLEM);
    }

    public function scopeSuggestions($query)
    {
        return $query->where('item_type', '=', self::SUGGESTION);
    }

    public function scopePraise($query)
    {
        return $query->where('item_type', '=', self::PRAISE);
    }

    public function scopeResolved($query)
    {
        return $query->where('is_resolved', '=', 1);
    }

    public function scopePending($query)
    {
        return $query->where('is_resolved', '=', 0);
    }

    public function getScore()
    {
        return $this->item_score;
    }

    public function resolve()
    {
        $this->is_resolved = true;
        $this->save();
    }

    public function toArray()
    {
        $array = parent::toArray();

        // small modifications
        $array['unixtime'] = strtotime($array['created_at']);
        $array['edited'] = strtotime($array['updated_at']);
        $array['timeago'] = time_ago($array['created_at']);
        $array['time'] = modding_link(rtrim($array['time']));
        $array['text'] = linkify(modding_link($array['text']));
        $array['icon'] = $array['is_resolved'] ? $this->icons['resolved'] : (@$this->icons[$array['type']] ?: '');

        // renames
        $array['id'] = $array['item_id'];
        $array['beatmap'] = $array['beatmap_id'];
        $array['resolved'] = $array['is_resolved'];

        // unsets
        unset($array['item_id']);
        unset($array['beatmapset_id']);
        unset($array['beatmap_id']);
        unset($array['is_resolved']);
        unset($array['created_at']);
        unset($array['updated_at']);
        if (!$array['deleted_at']) {
            unset($array['deleted_at']);
        }

        return $array;
    }
}
