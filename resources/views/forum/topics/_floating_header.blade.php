{{--
    Copyright 2015-2018 ppy Pty. Ltd.

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
<div
    class="forum-topic-floating-header js-forum-topic-headernav js-sync-height--reference"
    data-sync-height-target="forum-topic-headernav"
    data-visibility="hidden"
>
    <div class="forum-topic-floating-header__stripe u-forum--bg-link"></div>

    <div class="osu-page">
        <div class="forum-topic-headernav">
            <div class="forum-topic-headernav__logo">
                @include('objects.logo_menu', ['logoMenuHoverBgClass' => 'u-forum--bg-link'])
            </div>

            <div class="forum-topic-headernav__content">
                <div class="forum-topic-headernav__row">
                    @include('forum.topics._header_breadcrumb_small', [
                        'forum' => $topic->forum,
                    ])
                </div>

                <h1 class="forum-topic-headernav__row u-ellipsis-overflow">
                    <a
                        href="{{ route("forum.topics.show", $topic->topic_id) }}"
                        class="forum-topic-headernav__title-link"
                    >
                        {{ $topic->topic_title }}
                    </a>
                </h1>
            </div>
        </div>
    </div>
</div>
