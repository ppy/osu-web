{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.

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
        $menu['feature-votes'] = [
            'url' => route('forum.forums.show', ['forum' => $forum, 'sort' => 'feature-votes']),
            'title' => trans('sort.forum_topics.feature_votes'),
        ];
    }
@endphp
@if (count($menu) > 0)
    @php
        $defaultMenu = ['new' => [
            'url' => route('forum.forums.show', ['forum' => $forum]),
            'title' => trans('sort.forum_topics.new'),
        ]];

        if (!isset($sort) || !isset($menu[$sort])) {
            $sort = 'new';
        }
    @endphp
    <div class="sort sort--forum-topics">
        <div class="sort__items">
            <span class="sort__item sort__item--title">{{ trans('sort._') }}</span>

            @foreach ($defaultMenu + $menu as $menuSort => $menuItem)
                <a
                    class="
                        sort__item
                        sort__item--button
                        {{ ($sort ?? null) === $menuSort ? 'sort__item--active u-forum--link-text' : '' }}
                    "
                    href="{{ $menuItem['url'] }}#topics"
                >{{ $menuItem['title'] }}
                </a>
            @endforeach
        </div>
    </div>
@endif
