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
{!! Form::open([
    'url' => route('forum.posts.update', $post),
    'method' => 'patch',
    'data-remote' => true,
    'class' => 'js-forum-post-edit forum-post '.($post->userNormalized()->is_special ? 'forum-post--special' : ''),
    'data-post-position' => $post->postPosition,
]) !!}
    @if ($post->userNormalized()->is_special)
        <div
            class="forum-post__stripe"
            style="{{ user_colour_style($post->userNormalized()->user_colour, "background-color") }}"
        ></div>
    @endif

    @include("forum.topics._post_info", ["user" => $post->user])

    <div class="forum-post__body">
        <div class="forum-post__content">
            @include('forum.posts._form_body', ['postBody' => [
                'content' => $post->bodyRaw, 'focus' => true,
                'extraClasses' => 'forum-post-content--edit',
            ]])
        </div>

        <div class="forum-post__content forum-post__content--edit-bar">
            @include("forum.topics._post_box_footer", [
                "submitText" => trans("forum.topic.post_edit.post"),
                "editing" => true
            ])
        </div>
    </div>
{!! Form::close() !!}
