{{--
    Copyright 2015 ppy Pty. Ltd.

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
@foreach($posts as $post)
    <?php
        $withDeleteLink = Auth::check()
            ? $post->poster_id === Auth::user()->user_id
            : false;

        if (!$withDeleteLink) {
            $withDeleteLink = priv_check('ForumPostDelete', $post)->can();
        }
    ?>
    @include('forum.topics._post', [
        'post' => $post,
        'options' => [
            'deleteLink' => $withDeleteLink,
            'editLink' => priv_check('ForumPostEdit', $post)->can(),
            'postPosition' => $postsPosition[$post->post_id],
            'replyLink' => priv_check('ForumTopicReply', $topic)->can(),
        ],
    ])
@endforeach
