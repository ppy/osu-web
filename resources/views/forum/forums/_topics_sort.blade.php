{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $menu = [
        'new' => [
            'url' => route('forum.forums.show', ['forum' => $forum]),
            'title' => osu_trans('sort.forum_topics.new'),
        ],
        'created' => [
            'url' => route('forum.forums.show', ['forum' => $forum, 'sort' => 'created']),
            'title' => osu_trans('sort.forum_topics.created'),
        ]
    ];

    if ($forum?->isFeatureForum()) {
        $menu['feature-votes'] = [
            'url' => route('forum.forums.show', ['forum' => $forum, 'sort' => 'feature-votes']),
            'title' => osu_trans('sort.forum_topics.feature_votes'),
        ];
    }

    if (!isset($sort) || !isset($menu[$sort])) {
        $sort = 'new';
    }
@endphp
<div class="sort sort--forum-topics">
    <div class="sort__items">
        <span class="sort__item sort__item--title">{{ osu_trans('sort._') }}</span>

        @foreach ($menu as $menuSort => $menuItem)
            <a
                class="{{ class_with_modifiers('sort__item', 'button', ['active' => $sort === $menuSort]) }}"
                href="{{ $menuItem['url'] }}#topics"
            >{{ $menuItem['title'] }}
            </a>
        @endforeach
    </div>
</div>
