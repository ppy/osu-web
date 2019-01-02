{{--
    Copyright 2015-2019 ppy Pty. Ltd.

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
    $menu = [];

    if (optional($forum ?? null)->isFeatureForum()) {
        $menu[] = [
            'url' => route('forum.forums.show', ['forums' => $forum, 'sort' => 'feature-votes']),
            'title' => trans('forum.topics.index.sort.feature_votes'),
        ];
    }
@endphp
@if (count($menu) > 0)
    @php
        $menuId = 'topics-sort-'.rand();
        $menu[] = [
            'url' => route('forum.forums.show', ['forums' => $forum]),
            'title' => trans('forum.topics.index.sort.new'),
        ];
    @endphp
    <div>
        <button class="js-click-menu btn-osu-big btn-osu-big--forum-button-circle"
            data-click-menu-target="{{ $menuId }}"
        >
            <span class="fas fa-sort-amount-up"></span>
        </button>

        <div
            class="js-click-menu simple-menu simple-menu--forum-button"
            data-click-menu-id="{{ $menuId }}"
            data-visibility="hidden"
        >
            @foreach ($menu as $menuItem)
                <a
                    class="simple-menu__item u-forum--before-bg"
                    href="{{ $menuItem['url'] }}"
                >{{ $menuItem['title'] }}
                </a>
            @endforeach
        </div>
    </div>
@endif
