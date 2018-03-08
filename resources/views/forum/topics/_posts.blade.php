{{--
    Copyright 2015-2017 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License version 3
    as published by the Free Software Foundation.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
@php
    $postPosition = $firstPostPosition;
@endphp

@foreach($posts as $post)
    @php
        $withDeleteLink = Auth::check()
            ? $post->poster_id === Auth::user()->user_id
            : false;

        if (!$withDeleteLink) {
            $withDeleteLink = priv_check('ForumPostDelete', $post)->can();
        }

        if ($post->trashed() && $postPosition > 0) {
            $postPosition--;
        }

        // sync with:
        // - Post#isBeatmapsetPost (position check)
        // - Post#edit (option below)
        // - Post#delete (option below)
        $isBeatmapsetPost = $postPosition === 1 && $post->isBeatmapsetPost();
    @endphp
    @include('forum.topics._post', [
        'post' => $post,
        'options' => [
            'deleteLink' => !$isBeatmapsetPost && $withDeleteLink,
            'editLink' => !$isBeatmapsetPost && priv_check('ForumPostEdit', $post)->can(),
            'postPosition' => $postPosition,
            'replyLink' => priv_check('ForumTopicReply', $topic)->can(),
            'signature' => $topic->forum->enable_sigs,
        ],
    ])
    @php
        $postPosition++;
    @endphp
@endforeach
