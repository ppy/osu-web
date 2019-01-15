<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

namespace App\Transformers;

use App\Models\Beatmapset;
use App\Models\Build;
use App\Models\Comment;
use App\Models\Model;
use App\Models\NewsPost;
use League\Fractal;

class CommentableMetaTransformer extends Fractal\TransformerAbstract
{
    public function transform(?Model $commentable)
    {
        // probably belongs somewhere else
        if ($commentable instanceof Beatmapset) {
            $titlePrefix = trans('comments.commentable_name.beatmapset');
            $title = $commentable->artist.' - '.$commentable->title;
            $url = route('beatmapsets.show', $commentable);
        } elseif ($commentable instanceof Build) {
            $titlePrefix = trans('comments.commentable_name.build');
            $title = $commentable->updateStream->display_name.' '.$commentable->displayVersion();
            $url = build_url($commentable);
        } elseif ($commentable instanceof NewsPost) {
            $titlePrefix = trans('comments.commentable_name.news_post');
            $title = $commentable->title();
            $url = route('news.show', $commentable->slug);
        } else {
            $title = trans('comments.commentable_name._deleted');
            $url = null;
        }

        if (isset($commentable)) {
            $id = $commentable->getKey();
            $type = array_search_null(get_class($commentable), Comment::COMMENTABLES);
        }

        return [
            'id' => $id ?? null,
            'type' => $type ?? null,
            'title' => isset($titlePrefix) ? "{$titlePrefix}: {$title}" : $title,
            'url' => $url,
        ];
    }
}
