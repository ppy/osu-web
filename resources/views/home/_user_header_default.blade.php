{{--
    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
    See the LICENCE file in the repository root for full licence text.
--}}
@php
    $currentActive = app('route-section')->getCurrent('controller').'.'.app('route-section')->getCurrent('action');
@endphp
@include('layout._page_header_v4', ['params' => [
    'backgroundExtraClass' => 'js-current-user-cover',
    'currentActive' => $currentActive,
    'theme' => $themeOverride ?? 'home',

    'links' => [
        [
            'active' => $currentActive === 'home_controller.index',
            'title' => osu_trans('home.user.title'),
            'url' => route('home'),
        ],
        [
            'active' => $currentActive === 'friends_controller.index',
            'title' => osu_trans('friends.title_compact'),
            'url' => route('friends.index'),
        ],
        [
            'active' => $currentActive === 'follows_controller.index',
            'title' => osu_trans('follows.index.title_compact'),
            'url' => route('follows.index', ['subtype' => App\Models\Follow::DEFAULT_SUBTYPE]),
        ],
        [
            'active' => $currentActive === 'account_controller.edit',
            'title' => osu_trans('accounts.edit.title_compact'),
            'url' => route('account.edit'),
        ],
    ],
]])
