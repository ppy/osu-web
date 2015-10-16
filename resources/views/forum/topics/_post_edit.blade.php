{{--
    Copyright 2015 ppy Pty. Ltd.

    This file is part of osu!web. osu!web is distributed with the hope of
    attracting more community contributions to the core ecosystem of osu!.

    osu!web is free software: you can redistribute it and/or modify
    it under the terms of the Affero GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
    See the GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
--}}
<?php
    $isLarge = $post->postPosition === 1;
?>
{!! Form::open(["url" => route("forum.posts.update", $post), "method" => "patch", "data-remote" => true, "class" => "edit-post post-editor post-editor--edit", "data-post-position" => $post->postPosition]) !!}
    <div class="post-editor__main">
        <div class="info-panel">
            @include("forum.topics._post_info", ["user" => $post->user, "options" => ["large" => $isLarge ]])
        </div>

        <div class="post-panel">
            <textarea required class="js-quick-submit forum-post-content" name="body">{{ $post->bodyRaw }}</textarea>
        </div>
    </div>

    <div class="post-editor__footer {{ $isLarge ? "post-editor__footer--large" : "" }}">
        @include("forum.topics._post_box_footer", ["submitText" => trans("forum.topic.post_edit.post"), "editing" => true])
    </div>
{!! Form::close() !!}
