{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentActive = app('route-section')->getCurrent('controller').'.'.app('route-section')->getCurrent('action');
@endphp
@include('layout._page_header_v4', ['params' => [
    'backgroundExtraClass' => 'js-current-user-cover',
    'theme' => $themeOverride ?? 'home',

    'links' => [
        [
            'active' => $currentActive === 'home_controller.index',
            'title' => trans('home.user.title'),
            'url' => route('home'),
        ],
        [
            'active' => $currentActive === 'friends_controller.index',
            'title' => trans('friends.title_compact'),
            'url' => route('friends.index'),
        ],
        [
            'active' => $currentActive === 'topic_watches_controller.index',
            'title' => trans('forum.topic_watches.index.title_compact'),
            'url' => route('forum.topic-watches.index'),
        ],
        [
            'active' => $currentActive === 'beatmapset_watches_controller.index',
            'title' => trans('beatmapset_watches.index.title_compact'),
            'url' => route('beatmapsets.watches.index'),
        ],
        [
            'active' => $currentActive === 'account_controller.edit',
            'title' => trans('accounts.edit.title_compact'),
            'url' => route('account.edit'),
        ],
    ],
]])
