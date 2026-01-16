{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
<div
    class="js-forum-tag-editor u-relative"
    data-topic-id="{{ $topic->topic_id }}"
>
    <button
        type="button"
        class="btn-circle btn-circle--topic-nav js-menu"
        data-menu-target="tag-editor"
    >
        <span class="btn-circle__content">
            <i class="fa fa-tag"></i>
        </span>
    </button>
    <div
        class="js-menu simple-menu simple-menu--forum-topic-tag-editor"
        data-menu-id="tag-editor"
        data-visibility="hidden"
    >
        @foreach ($topic::ISSUE_TAGS as $category => $types)
            <span class="simple-menu__heading">{{ $category }}</span>
            @foreach ($types as $type)
                @include('forum.topics._issue_tag_'.str_slug($type))
            @endforeach
        @endforeach
    </div>
</div>
