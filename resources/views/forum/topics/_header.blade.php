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
<?php
    $headerCover = $cover['fileUrl'] ?? $cover['defaultFileUrl'] ?? null;
    $newTopic = !isset($topic);
?>
<div class="osu-page">
    @include('forum._header_breadcrumb', [
        'forum' => $forum ?? $topic->forum,
    ])

    <div
        class="forum-category-header
            forum-category-header--topic
            {{ $newTopic ?
                'forum-category-header--topic-create'
                : 'u-forum--topic-cover'
            }}
            js-forum-cover--header
            js-header--main"
        style="{{ $headerCover !== null ? "background-image: url('{$headerCover}');" : '' }}"
    >
        <div class="forum-category-header__loading js-forum-cover--loading">
            @include('objects._spinner')
        </div>

        <div class="forum-category-header__titles">
            @if ($newTopic)
                <input
                    class="forum-category-header__title js-form-placeholder-hide"
                    required
                    tabindex="1"
                    name="title"
                    type="text"
                    value="{{ Request::old("title") }}"
                    placeholder="{{ trans("forum.topic.create.placeholder.title") }}"
                    maxlength="{{ App\Models\Forum\Topic::MAX_FIELD_LENGTHS['topic_title'] }}"
                />
            @else
                <h1 class="forum-category-header__title">
                    @include('forum.topics._header_title')
                </h1>
            @endif

            <div class="forum-category-header__counters hidden-xs">
                <div class="forum-category-header__counter">
                    @include('forum.topics._header_total_counter')
                </div>

                @if(!$newTopic && priv_check('ForumTopicModerate', $topic)->can())
                    <div class="forum-category-header__counter">
                        @include('forum.topics._header_deleted_counter')
                    </div>
                @endif
            </div>
        </div>

        @if ($newTopic || priv_check('ForumTopicEdit', $topic)->can())
            <div class="forum-category-header__actions">
                @include('forum._cover_editor')
            </div>
        @endif
    </div>

    @if (!$newTopic)
        <div class="forum-topic-header__sticky-marker js-sticky-header" data-sticky-header-target="forum-topic-headernav"></div>
    @endif
</div>
