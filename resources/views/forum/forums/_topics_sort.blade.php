{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $menu = [];

    if (optional($forum ?? null)->isFeatureForum()) {
        $menu['feature-votes'] = [
            'url' => route('forum.forums.show', ['forum' => $forum, 'sort' => 'feature-votes']),
            'title' => osu_trans('sort.forum_topics.feature_votes'),
        ];
    }
@endphp
@if (count($menu) > 0)
    @php
        $defaultMenu = ['new' => [
            'url' => route('forum.forums.show', ['forum' => $forum]),
            'title' => osu_trans('sort.forum_topics.new'),
        ]];

        if (!isset($sort) || !isset($menu[$sort])) {
            $sort = 'new';
        }
    @endphp
    <div class="sort sort--forum-topics">
        <div class="sort__items">
            <span class="sort__item sort__item--title">{{ osu_trans('sort._') }}</span>

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
