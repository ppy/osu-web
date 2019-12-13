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
@include('layout._page_header_v4', ['params' => [
    'backgroundExtraClass' => 'js-current-user-cover',
    'section' => trans('layout.header.home._'),
    'subSection' => $title,
    'theme' => 'home',

    'links' => [
        [
            'active' => $currentAction === 'index',
            'title' => trans('home.user.title'),
            'url' => route('home'),
        ],
        [
            'active' => $currentAction === 'friends-index',
            'title' => trans('friends.title_compact'),
            'url' => route('friends.index'),
        ],
        [
            'active' => $currentAction === 'forum-topic-watches-index',
            'title' => trans('forum.topic_watches.index.title_compact'),
            'url' => route('forum.topic-watches.index'),
        ],
        [
            'active' => $currentAction === 'beatmapset-watches-index',
            'title' => trans('beatmapset_watches.index.title_compact'),
            'url' => route('beatmapsets.watches.index'),
        ],
        [
            'active' => $currentAction === 'account-edit',
            'title' => trans('accounts.edit.title_compact'),
            'url' => route('account.edit'),
        ],
    ],
]])
